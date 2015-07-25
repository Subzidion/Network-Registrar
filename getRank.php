<?php
  //Get's a Rank from RankID
  function getRankNameFromRankID($id) {
    //Check parameters as valid
    if(!is_int($id)) throw new Exception("Invalid Rank ID.");
    //Use Database Connection variable in registrarRequest
    global $dbConn;
    //Prepare query
    $query = "SELECT ranks.name AS rankName WHERE rank.ID = :id";
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
    if(!is_int($id)) throw new Exception("Invalid Rank ID.");
    //Use Database Connection variable in registrarRequest
    global $dbConn;
    //Prepare query
    $query = "SELECT ranks.info AS rankDescription WHERE rank.ID = :id";
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

  //Get's a RankDescription from RankName
  function getRankDescriptionFromRankName($name) {
    //Check parameters as valid
    if(!is_string($username)) throw new Exception("Invalid Divison name.");
    //Use Database Connection variable in registrarRequest
    global $dbConn;
    //Prepare query
    $query = "SELECT ranks.info AS rankDescription WHERE ranks.name = :name";
    //Prepare Statement
    $statement = $dbConn->prepare($query);
    //Bind parameter to query
    $statement->bindValue(':name', strval($name), PDO::PARAM_STR);
    //Execute, throw exception if query fails
    if(!$statement->execute()) throw new Exception("Query failed.");
    //Fetch result
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    //Create array of data to return
    $data = array('rankDescription'  => intval($result['rankDescription']));
    //Return array
    return $data;
  }

  //Get's a RankInsignia from RankID
  function getRankInsigniaFromRankID($id) {
    //Check parameters as valid
    if(!is_int($id)) throw new Exception("Invalid Rank ID.");
    //Use Database Connection variable in registrarRequest
    global $dbConn;
    //Prepare query
    $query = "SELECT ranks.insigniaUUID AS rankInsignia WHERE rank.ID = :id";
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

  //Get's a RankInsignia from RankName
  function getRankInsigniaFromRankName($name) {
    //Check parameters as valid
    if(!is_string($username)) throw new Exception("Invalid Divison name.");
    //Use Database Connection variable in registrarRequest
    global $dbConn;
    //Prepare query
    $query = "SELECT ranks.insigniaUUID AS rankDescription WHERE ranks.name = :name";
    //Prepare Statement
    $statement = $dbConn->prepare($query);
    //Bind parameter to query
    $statement->bindValue(':name', strval($name), PDO::PARAM_STR);
    //Execute, throw exception if query fails
    if(!$statement->execute()) throw new Exception("Query failed.");
    //Fetch result
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    //Create array of data to return
    $data = array('rankInsignia'  => intval($result['rankInsignia']));
    //Return array
    return $data;
  }
?>