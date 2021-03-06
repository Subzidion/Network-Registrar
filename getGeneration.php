<?php
  //Get's a Generation from GenerationID
  function getGenerationNameFromGenerationID($id) {
    //Check parameters as valid
    $id = intval($id);
    //Use Database Connection variable in registrarRequest
    global $dbConn;
    //Prepare query
    $query = "SELECT generations.name AS generationName FROM generations WHERE generations.ID = :id";
    //Prepare Statement
    $statement = $dbConn->prepare($query);
    //Bind parameter to query
    $statement->bindValue(':id', intval($id), PDO::PARAM_INT);
    //Execute, throw exception if query fails
    if(!$statement->execute()) throw new Exception("Query failed.");
    //Fetch result
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    //Create array of data to return
    $data = array('generationName'  => strval($result['generationName']));
    //Return array
    return $data;
  }
?>