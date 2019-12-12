<?php
session_start();
error_reporting(E_ERROR | E_PARSE | E_CORE_ERROR);

$dbConn = mysqli_connect('remotemysql.com', 'ffViMSmUaZ', 'vp4E5KRAv8','ffViMSmUaZ');
  if(!$dbConn){
  	die('Could not connect: ' . mysqli_error($dbConn));
  }

  $conn = new mysqli("remotemysql.com", "ffViMSmUaZ", "vp4E5KRAv8", "ffViMSmUaZ");

  if ($conn->connect_error) {
	die("Connection failed: " .  $conn->connect_error);
  }
?>