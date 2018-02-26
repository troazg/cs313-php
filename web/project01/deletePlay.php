<?php

session_start();
include('connection.php');

$stmt = $db->prepare('DELETE FROM play WHERE play_id = :id');
$stmt->bindValue(':id', $_POST['deletePlayID'], PDO::PARAM_INT);
$stmt->execute();

header('Location: mainpage.php');
?>