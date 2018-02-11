<?php
$dbUrl = getenv('DATABASE_URL');
if (!empty($dbUrl)) {
	$dbopts = parse_url($dbUrl);
	$dbHost = $dbopts["host"];
	$dbPort = $dbopts["port"];
	$dbUser = $dbopts["user"];
	$dbPassword = $dbopts["pass"];
	$dbName = ltrim($dbopts["path"],'/');
	$db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
} else {
	$db = new PDO('pgsql:host=localhost;dbname=cs313db', 'bnelson');
}
// ?>