<?php
  //Get's a Division from DivisionID
  function getDivisionNameFromDivisionID($id) {
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

  //Get's a DivisionDescription from DivisionID
  function getDivisionDescriptionFromDivisionID($id) {
    //Check parameters as valid
    if(!is_int($id)) throw new Exception("Invalid Division ID.");
    //Use Database Connection variable in registrarRequest
    global $dbConn;
    //Prepare query
    $query = "SELECT divisions.info AS divisionDescription WHERE division.ID = :id";
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
    //Check parameters as valid
    if(!is_string($username)) throw new Exception("Invalid Divison name.");
    //Use Database Connection variable in registrarRequest
    global $dbConn;
    //Prepare query
    $query = "SELECT divisions.info AS divisionDescription WHERE divisions.name = :name";
    //Prepare Statement
    $statement = $dbConn->prepare($query);
    //Bind parameter to query
    $statement->bindValue(':name', strval($name), PDO::PARAM_STR);
    //Execute, throw exception if query fails
    if(!$statement->execute()) throw new Exception("Query failed.");
    //Fetch result
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    //Create array of data to return
    $data = array('divisionDescription'  => intval($result['divisionDescription']));
    //Return array
    return $data;
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
    //Check parameters as valid
    if(!is_string($username)) throw new Exception("Invalid Divison name.");
    //Use Database Connection variable in registrarRequest
    global $dbConn;
    //Prepare query
    $query = "SELECT divisions.insigniaUUID AS divisionDescription WHERE divisions.name = :name";
    //Prepare Statement
    $statement = $dbConn->prepare($query);
    //Bind parameter to query
    $statement->bindValue(':name', strval($name), PDO::PARAM_STR);
    //Execute, throw exception if query fails
    if(!$statement->execute()) throw new Exception("Query failed.");
    //Fetch result
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    //Create array of data to return
    $data = array('divisionInsignia'  => intval($result['divisionInsignia']));
    //Return array
    return $data;
  }
?>