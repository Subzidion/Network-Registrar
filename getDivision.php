<?php
  //Get's a Division from DivisionID
  function getDivisionNameFromDivisionID($id) {
    //Check parameters as valid
    $id = intval($id);
    //Use Database Connection variable in registrarRequest
    global $dbConn;
    //Prepare query
    $query = "SELECT division.name AS divisionName FROM division WHERE division.ID = :id";
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

  //Get's a DivisionID from a Division Name
  function getDivisionIDFromDivisionName($name) {
    //Check parameters as valid
    if(!is_string($name)) throw new Exception("Invalid Division name.");
    //Use Database Connection variable in registrarRequest
    global $dbConn;
    //Prepare query
    $query = "SELECT division.ID AS divisionID FROM division WHERE division.name = :name";
    //Prepare Statement
    $statement = $dbConn->prepare($query);
    //Bind parameter to query
    $statement->bindValue(':name', $name, PDO::PARAM_STR);
    //Execute, throw exception if query fails
    if(!$statement->execute()) throw new Exception("Query failed.");
    //Fetch result
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    //Create array of data to return
    $data = array('divisionID'  => intval($result['divisionID']));
    //Return array
    return $data;
  }

  //Get's a DivisionDescription from DivisionID
  function getDivisionDescriptionFromDivisionID($id) {
    //Check parameters as valid
    $id = intval($id);
    //Use Database Connection variable in registrarRequest
    global $dbConn;
    //Prepare query
    $query = "SELECT division.info AS divisionDescription FROM division  WHERE division.ID = :id";
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

  //Get's a DivisionInsignia from DivisionID
  function getDivisionInsigniaFromDivisionID($id) {
    //Check parameters as valid
    $id = intval($id);
    //Use Database Connection variable in registrarRequest
    global $dbConn;
    //Prepare query
    $query = "SELECT division.insigniaUUID AS divisionInsignia FROM division  WHERE division.ID = :id";
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

  //Get's a DivisionDescription from DivisionName
  function getDivisionDescriptionFromDivisionName($name) {
    //Check parameters as valid
    if(!is_string($name)) throw new Exception("Invalid Divison name.");
    //Use Database Connection variable in registrarRequest
    global $dbConn;
    //Prepare query
    $query = "SELECT division.info AS divisionDescription FROM division  WHERE division.name = :name";
    //Prepare Statement
    $statement = $dbConn->prepare($query);
    //Bind parameter to query
    $statement->bindValue(':name', strval($name), PDO::PARAM_STR);
    //Execute, throw exception if query fails
    if(!$statement->execute()) throw new Exception("Query failed.");
    //Fetch result
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    //Create array of data to return
    $data = array('divisionDescription'  => strval($result['divisionDescription']));
    //Return array
    return $data;
  }
  
  //Get's a DivisionInsignia from DivisionName
  function getDivisionInsigniaFromDivisionName($name) {
    //Check parameters as valid
    if(!is_string($name)) throw new Exception("Invalid Divison name.");
    //Use Database Connection variable in registrarRequest
    global $dbConn;
    //Prepare query
    $query = "SELECT division.insigniaUUID AS divisionInsignia FROM division  WHERE division.name = :name";
    //Prepare Statement
    $statement = $dbConn->prepare($query);
    //Bind parameter to query
    $statement->bindValue(':name', strval($name), PDO::PARAM_STR);
    //Execute, throw exception if query fails
    if(!$statement->execute()) throw new Exception("Query failed.");
    //Fetch result
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    //Create array of data to return
    $data = array('divisionInsignia'  => strval($result['divisionInsignia']));
    //Return array
    return $data;
  }
?>