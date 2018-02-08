<?php

session_start();

reset($_POST);

$key = key($_POST);

$_SESSION[$key] = $_POST[$key];

?>