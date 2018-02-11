<?php
session_start();
//include_once('debugHelper.php');
if ($_GET['logout'] == 1 AND $_SESSION['id']){
	session_destroy();
	//debug_to_console("Logout Action");
	$message = "You have been logged out. Have a great day!";
}
include("connection.php");
if ($_POST['submit'] == "Sign Up") {
	//debug_to_console('You clicked sign up');
	if (!$_POST['username']) 
		$error .= "<br>Please choose a Username";
	
	if (!($_POST['password']))
		$error .= "<br>Please enter your password";
	else {
		if (strlen($_POST['password']) < 8)
			$error .= "<br>Please enter a password with at least 8 characters";
		if (!preg_match('`[A-Z]`', $_POST['password']))
			$error .= "<br>Please include at least one capital letter in password";
		if ($_POST['password2'] AND $_POST['password'] != $_POST['password2'])
			$error .="<br>Passwords do not match";
	}
	if ($error)
		$error = "<strong>There were errors in your signup details:</strong> ".$error;
	else {
		//debug_to_console("Checking the DB");
		
		$query = $db->prepare('SELECT * FROM users WHERE username = :username');
		$query->bindValue(':username', $_POST['username'], PDO::PARAM_STR);
		$query->execute();
		$rows = $query->fetch(PDO::FETCH_ASSOC);
		if ($rows)
			$error = "There is already an account with that username. Do you want to log in?";
		else {
			//debug_to_console("Creating new account");
			
			//$query = "INSERT INTO `users` (`user_email`, `user_password`) VALUES ('".pg_escape_string($db, $_POST['email'])."', '".md5(md5($_POST['email']).$_POST['password'])."')";
			$passhash = md5(md5($_POST['username']).$_POST['password']);
			$query = $db->prepare('INSERT INTO users (username, user_password) VALUES (:username, :passhash)');
			$query->bindValue(':username', $_POST['username'], PDO::PARAM_STR);
			$query->bindValue(':passhash', $passhash, PDO::PARAM_STR);
			$query->execute();
			//$rows = $query->fetchAll(PDO::FETCH_ASSOC);
			$userID = $db->lastInsertId();
			//echo "You've been signed up!";
			
			$_SESSION['id'] = $userID;
			//debug_to_console($userID);
			header('Location: mainpage.php');
		}
	}
}
if ($_POST['submit'] == "Log In") {
	//debug_to_console("Trying to log in");
	
	$passhash1 = md5(md5($_POST['loginUsername']).$_POST['loginPassword']);
	//debug_to_console($passhash1);
	$un = $_POST['loginUsername'];
	$query = $db->prepare('SELECT * FROM users WHERE username = :username AND user_password = :passhash LIMIT 1');
	$query->execute(array(':username' => $un, ':passhash' => $passhash1));
	//$query->bindValue(':email', $_POST['loginEmail'], PDO::PARAM_STR);
	//$query->bindValue(':passhash', $passhash1, PDO::PARAM_STR);
	//$query->execute();
	
	$rows = $query->fetch(PDO::FETCH_ASSOC); 
	
	
	if ($rows) {
		$_SESSION['id'] = $rows['user_id'];
		header('Location: mainpage.php');
	} else {
		$error = "<strong>We could not find a user with that email and password. Please try again or sign up for a new account.</strong>";
	}
}
?>