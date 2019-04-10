<?php
if ($_SERVER['REQUEST_METHOD']) {
	header('HTTP/1.0 403 Forbidden');
	echo 'You are forbidden!';
	exit;
}
$DB_DSN = 'mysql:dbname=camagru;host=127.0.0.1';
$DB_NAME = 'camagru';
$DB_USER = 'root';
$DB_PASSWORD = 'r00tr00t';
$DB_HOST="127.0.0.1"; 
