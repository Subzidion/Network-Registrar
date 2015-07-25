<?php
  //Get's a Personnel ID from a Username
  function getPIDFromUsername($username) {
    //Check parameters as valid
    if(!is_string($username)) throw new Exception("Invalid username.");
    //Use Database Connection variable in registrarRequest
    global $dbConn;
    //Prepare query
    $query = "SELECT accounts.PID AS PID WHERE accounts.username = :username";
    //Prepare Statement
    $statement = $dbConn->prepare($query);
    //Bind parameter to query
    $statement->bindValue(':username', strval($username), PDO::PARAM_STRING);
    //Execute, throw exception if query fails
    if(!$statement->execute()) throw new Exception("Query failed.");
    //Fetch result
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    //Create array of data to return
    $data = array('PID'  => intval($result['PID']));
    //Return array
    return $data;
  }

  //Get's a Personnel ID from a UUID
  function getPIDFromUUID($uuid) {
    //Check parameters as valid
    if(!is_string($uuid) || strlen($uuid) != 36) throw new Exception("Invalid UUID.");
    //Use Database Connection variable in registrarRequest
    global $dbConn;
    //Prepare query
    $query = "SELECT accounts.PID AS PID WHERE accounts.UUID = :uuid";
    //Prepare Statement
    $statement = $dbConn->prepare($query);
    //Bind parameter to query
    $statement->bindValue(':uuid', strval($uuid), PDO::PARAM_STRING);
    //Execute, throw exception if query fails
    if(!$statement->execute()) throw new Exception("Query failed.");
    //Fetch result
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    //Create array of data to return
    $data = array('PID'  => intval($result['PID']));
    //Return array
    return $data;
  }
?>