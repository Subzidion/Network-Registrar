<?php
  //Get's a Personnel ID from a Username
  function getPIDFromUsername($username) {
    //Check parameters as valid
    if(!is_string($username)) throw new Exception("Invalid username.");
    //Use Database Connection variable in registrarRequest
    global $dbConn;
    //Prepare query
    $query = "SELECT accounts.PID AS PID FROM accounts WHERE accounts.username = :username";
    //Prepare Statement
    $statement = $dbConn->prepare($query);
    //Bind parameter to query
    $statement->bindValue(':username', strval($username), PDO::PARAM_STR);
    //Execute, throw exception if query fails
    if(!$statement->execute()) throw new Exception("Query failed.");
    //Fetch result
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    //Return array;
    return $result;
  }

  //Get's a Personnel ID from a UUID
  function getPIDFromUUID($uuid) {
    //Check parameters as valid
    if(!is_string($uuid) || strlen($uuid) != 36) throw new Exception("Invalid UUID.");
    //Use Database Connection variable in registrarRequest
    global $dbConn;
    //Prepare query
    $query = "SELECT accounts.PID AS PID from accounts WHERE accounts.UUID = :uuid";
    //Prepare Statement
    $statement = $dbConn->prepare($query);
    //Bind parameter to query
    $statement->bindValue(':uuid', strval($uuid), PDO::PARAM_STR);
    //Execute, throw exception if query fails
    if(!$statement->execute()) throw new Exception("Query failed.");
    //Fetch result
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    //Return array
    return $result;
  }

  //Convert _POST values of UUID or Username or PID to PID
  function getPID() {
      if(isset($_POST['UUID'])) return getPIDFromUUID($_POST['UUID'])['PID'];
      //Username -> PID
      else if(isset($_POST['username'])) return getPIDFromUsername($_POST['username'])['PID'];
      //PID
      else if(isset($_POST['PID'])) return $_POST['PID'];
      //What to return when a user is not found in the database
      if($targetPID == 0) die(json_encode(array("User not found.")));
      return $targetPID;
  }
?>