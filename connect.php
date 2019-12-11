<?php
session_start();
error_reporting(E_ERROR | E_PARSE | E_CORE_ERROR);


$con = mysql_connect("localhost","webplayglobal","@eme37v5");
if (!$con){
  die('Could not connect: ' . mysql_error());
}

mysql_select_db("webplayg_tranx", $con);


?>