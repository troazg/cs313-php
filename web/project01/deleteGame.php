<?php   
session_start();
include("connection.php");

$stmt = $db->prepare('DELETE FROM ownership WHERE ownership_game_id = :game AND ownership_user_id = :user');
$stmt->bindValue(':game', $_POST['deleteGameID'], PDO::PARAM_INT);
$stmt->bindValue(':user', $_POST['deleteGameUserID'], PDO::PARAM_INT);
$stmt->execute();

header('Location: mainpage.php');

?>