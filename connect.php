<?php
session_start();
error_reporting(E_ERROR | E_PARSE | E_CORE_ERROR);


$con = mysql_connect("remotemysql.com","ffViMSmUaZ","vp4E5KRAv8");
if (!$con){
  die('Could not connect: ' . mysql_error());
}

mysql_select_db("ffViMSmUaZ", $con);


?>