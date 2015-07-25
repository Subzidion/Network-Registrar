<?php
  //Include the SecretKey
  include "../../overwatch/info.php";
  //Include Database Information
  include "../../external_includes/mysql_network_config.php";
  include "getAccessRights.php";

  function errorReport($message) {
    die("ERROR: " . $message);
  }

  //AUTHENTICATE REQUEST
  if(!isset($_POST['key']) || $_POST['key'] !== $secretKey) errorReport("Access denied.");
  if(!isset($_SERVER['HTTP_X_SECONDLIFE_SHARD'])) errorReport("Access denied.");

  //Connect to Database. Need to determine if requesting user is authorized
  try {
    $dbConn = new PDO("mysql:host=$dbServer;dbname=$dbName", $dbUser, $dbPassword);
  } catch(PDOException $e) {
    errorReport("Database connection failed.");
  } 

  $requestUUID = $_SERVER["HTTP_X_SECONDLIFE_OWNER_KEY"];
  try {
    if(count(getAccessRightsFromUUID($requestUUID)) == 0) errorReport("Access denied.");
  } catch(Exception $e) {
    errorReport($e->getMessage());
  }
?>    
