<?php 
include('login.php');

// foreach ($db->query('SELECT * FROM users') as $row) {
// 	echo 'ID: '.$row['user_id'];
// 	echo ' | Email: '.$row['user_email'];
// 	echo ' | Passhash: '.$row['user_password'];
// 	echo ' | Diary: '.$row['user_diary'];
// }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    

    <title>Board Game Collection Login</title>

    <!--jQuery-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

	<link rel="stylesheet" type="text/css" href="styles.css">
    
	

  </head>
<body>

<div class="container text-center" id="main">  
<div class="row">
<div class="col-md-6 col-md-offset-3">

<div id="title">
	<h1>Board Game Collection</h1>
	<p class="lead">Access your collection from anywhere with an internet connection.</p>
</div>

<div><h2><a id="signUpToggle" role="button" data-toggle="collapse" href="#collapsedSignUp">New to the site? Sign up here!</a></h2></div>

<div class="collapse in" id="collapsedSignUp">
	<?php
		if ($error) {
			echo '<div class="alert alert-danger">'.addslashes($error).'</div>';
		}
		if ($message) {
			echo '<div class="alert alert-success">'.addslashes($message).'</div>';
		}
	?>
	   
	<form method="post" id="signUpForm">
		<div class="form-group">
			<label for="username">Username</label>
			<input type="text" name="username" id="username" class="form-control" value="<?php echo addslashes($_POST['username']) ?>" />
		</div>

		<div class="form-group">
			<label for="password">Password</label>
			<input type="password" name="password" class="form-control" id="password" />
		</div>

		<div class="form-group">
			<label for="password2">Retype Password</label>
			<input type="password" name="password2" class="form-control" id="password2">
		</div>

		<input type="submit" class="btn btn-primary" name="submit" value="Sign Up">

	</form>
</div>

<div><h2><a id="logInToggle" role="button" data-toggle="collapse" href="#collapsedLogin">Already have an account? Log in here!</a></h2></div>

<div class="collapse" id="collapsedLogin">
	
	<form method="post" id="loginForm">
		<div class="form-group">
			<label for="loginUsername">Username</label>	
			<input type="text" class="form-control" name="loginUsername" id="loginUsername " value="<?php echo addslashes($_POST['loginUsername']) ?>" />
		</div>
		<div class="form-group">
			<label for="loginPassword">Password</label>
			<input type="password" class="form-control" name="loginPassword" id="loginPassword" value="<?php echo addslashes($_POST['loginPassword']) ?>"/>
		</div>
		<input type="submit" class="btn btn-primary" name="submit" value="Log In">	
	</form>
	
</div>

</div>

</div>
</div>


<script type="text/javascript">
	$("#logInToggle").click(function() {
		$("#collapsedSignUp").collapse('hide');
	});
	$("#signUpToggle").click(function() {
		$("#collapsedLogin").collapse('hide');
	});
	
</script>    
    
</body>
</html>
