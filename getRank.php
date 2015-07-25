<?php
  //Get's a Rank from RankID
  function getRankNameFromRankID($id) {
    //Check parameters as valid
    $id = intval($id);
    //Use Database Connection variable in registrarRequest
    global $dbConn;
    //Prepare query
    $query = "SELECT ranks.name AS rankName FROM ranks WHERE ranks.ID = :id";
    //Prepare Statement
    $statement = $dbConn->prepare($query);
    //Bind parameter to query
    $statement->bindValue(':id', intval($id), PDO::PARAM_INT);
    //Execute, throw exception if query fails
    if(!$statement->execute()) throw new Exception("Query failed.");
    //Fetch result
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    //Create array of data to return
    $data = array('rankName'  => strval($result['rankName']));
    //Return array
    return $data;
  }

  //Get's a RankDescription from RankID
  function getRankDescriptionFromRankID($id) {
    //Check parameters as valid
    $id = intval($id);
    //Use Database Connection variable in registrarRequest
    global $dbConn;
    //Prepare query
    $query = "SELECT ranks.info AS rankDescription FROM ranks WHERE ranks.ID = :id";
    //Prepare Statement
    $statement = $dbConn->prepare($query);
    //Bind parameter to query
    $statement->bindValue(':id', intval($id), PDO::PARAM_INT);
    //Execute, throw exception if query fails
    if(!$statement->execute()) throw new Exception("Query failed.");
    //Fetch result
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    //Create array of data to return
    $data = array('rankDescription'  => strval($result['rankDescription']));
    //Return array
    return $data;
  }

  //Get's a RankInsignia from RankID
  function getRankInsigniaFromRankID($id) {
    //Check parameters as valid
    $id = intval($id);
    //Use Database Connection variable in registrarRequest
    global $dbConn;
    //Prepare query
    $query = "SELECT ranks.insigniaUUID AS rankInsignia FROM ranks WHERE ranks.ID = :id";
    //Prepare Statement
    $statement = $dbConn->prepare($query);
    //Bind parameter to query
    $statement->bindValue(':id', intval($id), PDO::PARAM_INT);
    //Execute, throw exception if query fails
    if(!$statement->execute()) throw new Exception("Query failed.");
    //Fetch result
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    //Create array of data to return
    $data = array('rankInsignia'  => strval($result['rankInsignia']));
    //Return array
    return $data;
  }
?>