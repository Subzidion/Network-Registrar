<?php
  //Get's a Username from a PID
  function getUsernameFromPID($pid) {
    //Check parameters as valid
    if(!is_int($pid)) throw new Exception("Invalid Personnel ID.");
    //Use Database Connection variable in registrarRequest
    global $dbConn;
    //Prepare query
    $query = "SELECT accounts.username AS username FROM accounts WHERE accounts.PID = :pid";
    //Prepare Statement
    $statement = $dbConn->prepare($query);
    //Bind parameter to query
    $statement->bindValue(':pid', intval($pid), PDO::PARAM_INT);
    //Execute, throw exception if query fails
    if(!$statement->execute()) throw new Exception("Query failed.");
    //Fetch result
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    //Create array of data to return
    $data = array('username'  => strval($result['username']));
    //Return array
    return $data;
  }
?>