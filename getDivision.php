<?php
  //Get's a Division from DivisionID
  function getDivisionFromDivisionID($id) {
    //Check parameters as valid
    if(!is_int($id)) throw new Exception("Invalid Division ID.");
    //Use Database Connection variable in registrarRequest
    global $dbConn;
    //Prepare query
    $query = "SELECT divisions.name AS divisionName WHERE division.ID = :id";
    //Prepare Statement
    $statement = $dbConn->prepare($query);
    //Bind parameter to query
    $statement->bindValue(':id', intval($id), PDO::PARAM_INT);
    //Execute, throw exception if query fails
    if(!$statement->execute()) throw new Exception("Query failed.");
    //Fetch result
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    //Create array of data to return
    $data = array('divisionName'  => strval($result['divisionName']));
    //Return array
    return $data;
  }

  //Get's a Division from DivisionName
  function getDivisionFromDivisionName($name) {

  }

  //Get's a DivisionDescription from DivisionID
  function getDivisionDescriptionFromDivisionID($id) {
    //Check parameters as valid
    if(!is_int($id)) throw new Exception("Invalid Division ID.");
    //Use Database Connection variable in registrarRequest
    global $dbConn;
    //Prepare query
    $query = "SELECT divisions.description AS divisionDescription WHERE division.ID = :id";
    //Prepare Statement
    $statement = $dbConn->prepare($query);
    //Bind parameter to query
    $statement->bindValue(':id', intval($id), PDO::PARAM_INT);
    //Execute, throw exception if query fails
    if(!$statement->execute()) throw new Exception("Query failed.");
    //Fetch result
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    //Create array of data to return
    $data = array('divisionDescription'  => strval($result['divisionDescription']));
    //Return array
    return $data;
  }

  //Get's a DivisionDescription from DivisionName
  function getDivisionDescriptionFromDivisionName($name) {

  }

  //Get's a DivisionInsignia from DivisionID
  function getDivisionInsigniaFromDivisionID($id) {
    //Check parameters as valid
    if(!is_int($id)) throw new Exception("Invalid Division ID.");
    //Use Database Connection variable in registrarRequest
    global $dbConn;
    //Prepare query
    $query = "SELECT divisions.insigniaUUID AS divisionInsignia WHERE division.ID = :id";
    //Prepare Statement
    $statement = $dbConn->prepare($query);
    //Bind parameter to query
    $statement->bindValue(':id', intval($id), PDO::PARAM_INT);
    //Execute, throw exception if query fails
    if(!$statement->execute()) throw new Exception("Query failed.");
    //Fetch result
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    //Create array of data to return
    $data = array('divisionInsignia'  => strval($result['divisionInsignia']));
    //Return array
    return $data;
  }

  //Get's a DivisionInsignia from DivisionName
  function getDivisionInsigniaFromDivisionName($name) {

  }
?>