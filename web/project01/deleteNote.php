<?php

session_start();
include('connection.php');

$stmt = $db->prepare('DELETE FROM note WHERE note_id = :id');
$stmt->bindValue(':id', $_POST['deleteNoteID'], PDO::PARAM_INT);
$stmt->execute();

header('Location: mainpage.php');

?>