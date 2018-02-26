
<?php 

session_start();
include('connection.php');



if ($_POST['formID'] == "newGameForm") {
	$gameID = null;
	$publisherID = null;

	if ($_POST['addPublisherSelector'] == "new") {
		$stmt = $db->prepare('INSERT INTO publisher (publisher_name, publisher_website) VALUES (:publisherName, :publisherWebsite)');
		$stmt->bindValue(':publisherName', $_POST['newPublisherName'], PDO::PARAM_STR);
		$stmt->bindValue(':publisherWebsite', $_POST['newPublisherWebsite'], PDO::PARAM_STR);
		$stmt->execute();

		$publisherID = $db->lastInsertId();

	} else {
		$publisherID = $_POST['addPublisherSelector'];
	}

	if ($_POST['addGameSelector'] == "new") {
		$stmt = $db->prepare('INSERT INTO game (game_name, game_min_players, game_max_players, game_publisher) VALUES (:gameName, :gameMin, :gameMax, :publisher)');
		$stmt->bindValue(':gameName', $_POST['newGameName'], PDO::PARAM_STR);
		$stmt->bindValue(':gameMin', $_POST['newGameMinPlayers'], PDO::PARAM_INT);
		$stmt->bindValue(':gameMax', $_POST['newGameMaxPlayers'], PDO::PARAM_INT);
		$stmt->bindValue(':publisher', $publisherID, PDO::PARAM_INT);
		$stmt->execute();

		$gameID = $db->lastInsertId();

	} else {

		$stmt = $db->prepare('SELECT * FROM ownership WHERE ownership_game_id = :game AND ownership_user_id = :user');
		$stmt->bindValue(':game', $_POST['addGameSelector'], PDO::PARAM_INT);
		$stmt->bindValue(':user', $_SESSION['id'], PDO::PARAM_INT);
		$stmt->execute();
		$rows = $stmt->fetch(PDO::FETCH_ASSOC);
		if ($rows)
			$error = "This game is already in your collection.";
		else
			$gameID = $_POST['addGameSelector'];
	}

	if (!$error) {
		$stmt = $db->prepare('INSERT INTO ownership (ownership_game_id, ownership_user_id) VALUES (:game, :user)');
		$stmt->bindValue(':game', $gameID, PDO::PARAM_INT);
		$stmt->bindValue(':user', $_SESSION['id'], PDO::PARAM_INT);
		$stmt->execute();

		header('Location: mainpage.php');
	} else {
		$_SESSION['error'] = $error;
		header('Location: mainpage.php');
	}

}

if ($_POST['formID'] == "addPlay") {
	$stmt = $db->prepare('INSERT INTO play (play_game, play_players, play_winner, play_score, play_owner) VALUES (:game, :players, :winner, :score, :owner)');
	$stmt->bindValue(':game', $_POST['addPlayGameID'], PDO::PARAM_INT);
	$stmt->bindValue(':players', $_POST['addPlayPlayers'], PDO::PARAM_STR);
	$stmt->bindValue(':winner', $_POST['addPlayWinner'], PDO::PARAM_STR);
	$stmt->bindValue(':score', $_POST['addPlayScore'], PDO::PARAM_INT);
	$stmt->bindValue(':owner', $_SESSION['id'], PDO::PARAM_INT);
	$stmt->execute();

	header('Location: mainpage.php');

}

if ($_POST['formID'] == "addNote") {
	$stmt = $db->prepare('INSERT INTO note (note_game, note_text, note_owner) VALUES (:game, :noteText, :owner)');
	$stmt->bindValue(':game', $_POST['addNoteGameID'], PDO::PARAM_INT);
	$stmt->bindValue(':noteText', $_POST['addNoteText'], PDO::PARAM_STR);
	$stmt->bindValue(':owner', $_SESSION['id'], PDO::PARAM_INT);
	$stmt->execute();

	header('Location: mainpage.php');
}



?>