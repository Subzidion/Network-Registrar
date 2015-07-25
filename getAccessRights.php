<?php
  //Get's a Personnel's Access Rights from UUID
  function getAccessRightsFromUUID($uuid) {
    //Check parameters as valid
    if(!is_string($uuid) || strlen($uuid) != 36) throw new Exception("Invalid UUID.");
    //Use Database Connection variable in registrarRequest
    global $dbConn;
    //Prepare query
    $query = "SELECT accounts.PID AS PID FROM accounts WHERE accounts.UUID = :uuid";
    //Prepare Statement
    $statement = $dbConn->prepare($query);
    //Bind parameter to query
    $statement->bindValue(':uuid', strval($uuid), PDO::PARAM_STR);
    if(!$statement->execute()) throw new Exception("Query failed: " . $statement->errorInfo()[2] .".");
    //Fetch result
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    //Prepare query
    $query = "SELECT personnel.accessrights AS accessRights FROM personnel WHERE personnel.ID = :pid";
    //Prepare Statement
    $statement = $dbConn->prepare($query);
    //Bind parameter to query
    $statement->bindValue(':pid', intval($result['PID']), PDO::PARAM_STR);
    //Execute, throw exception if query fails
    if(!$statement->execute()) throw new Exception("Query failed: " . $statement->errorInfo()[2] .".");
    //Fetch result
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    //Create array of data to return
    $data = array('accessRights'  => intval($result['accessRights']));
    //Return array
    return $data;
  }
?>