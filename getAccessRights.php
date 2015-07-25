<?php
  //Get's a Personnel's Access Rights from UUID
  function getAccessRightsFromUUID($uuid) {
    //Check parameters as valid
    if(!is_string($uuid) || strlen($uuid) != 36) throw new Exception("Invalid UUID.");
    //Use Database Connection variable in registrarRequest
    global $dbConn;
    //Prepare query
    $query = "SELECT personnel.accessrights AS accessRights WHERE personnel.ID = :uuid";
    //Prepare Statement
    $statement = $dbConn->prepare($query);
    //Bind parameter to query
    $statement->bindValue(':uuid', strval($uuid), PDO::PARAM_STRING);
    //Execute, throw exception if query fails
    if(!$statement->execute()) throw new Exception("Query failed.");
    //Fetch result
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    //Create array of data to return
    $data = array('accessRights'  => intval($result['accessRights']));
    //Return array
    return $data;
  }
?>