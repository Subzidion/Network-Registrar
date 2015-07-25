<?php
  //Include the SecretKey
  include("../../overwatch/info.php");
  //Include Database Information
  include "../../external_includes/mysql_network_config.php";

  function errorReport($message) {
    die("ERROR: " . $message);
  }

  //AUTHENTICATE REQUEST
  if(!isset($_POST['key']) || $_POST['key'] !== $secretKey) error("Access denied.");
  if(!isset($_SERVER['HTTP_X_SECONDLIFE_SHARD'])) error("Access denied.");

  //Connect to Database. Need to determine if requesting user is authorized
  try {
    $dbConn = new PDO("mysql:host=$dbServer;dbName=$dbName", $dbUser, $dbPass);
  } catch(PDOException $e) {
    error("Database connection failed.");
  }
  
  $requestUUID = $_SERVER["HTTP_X_SECONDLIFE_OWNER_KEY"];

  $dbConn = null;
?>    
