<?php
  //Get's a Personnel by PID
  function getPersonnelByPID($pid) {
    //Check parameters as valid
    $pid = intval($pid);
    //Use Database Connection variable in registrarRequest
    global $dbConn;
    //Prepare query
    $query = "SELECT personnel.PID AS PID, personnel.active AS active, personnel.accessrights AS accessRights, personnel.joindate AS joinDate, personnel.generationID AS generationID, personnel.rankID AS rankID, personnel.divisionID AS divisionID, personnel.batchID AS batchID FROM personnel WHERE personnel.PID = :pid";
    //Prepare Statement
    $statement = $dbConn->prepare($query);
    //Bind parameter to query
    $statement->bindValue(':pid', intval($pid), PDO::PARAM_INT);
    //Execute, throw exception if query fails
    if(!$statement->execute()) throw new Exception("Query failed: " . $statement->errorInfo()[2] .".");
    //Fetch result
    $result =  $statement->fetch(PDO::FETCH_ASSOC);
    $result['PID'] = str_pad($result['PID'], 3, "0", STR_PAD_LEFT);
    if($result['active'] == 1) $result['active'] = "Yes";
    else if($result['active'] == 0) $result['active'] = "No";
    if($result['accessRights'] == 1) $result['accessRights'] = "Yes";
    else if($result['accessRights'] == 0) $result['accessRights'] = "No";
    $result['generationID'] = getGenerationNameFromGenerationID($result['generationID'])['generationName'];
    $result['rankID'] = getRankNameFromRankID($result['rankID'])['rankName'];
    $result['divisionID'] = getDivisionNameFromDivisionID($result['divisionID'])['divisionName'];
    $result['batchID'] = str_pad($result['batchID'], 3, "0", STR_PAD_LEFT);
    return $result;
  }

  //Get's a Personnel by Division
  function getPersonnelByDivision($division) {
    //Use Database Connection variable in registrarRequest
    global $dbConn;
    //Prepare query
    $query = "SELECT personnel.PID AS PID, personnel.active AS active, personnel.accessrights AS accessRights, personnel.joindate AS joinDate, personnel.generationID AS generationID, personnel.rankID AS rankID, personnel.divisionID AS divisionID, personnel.batchID AS batchID FROM personnel WHERE personnel.divisionID = :id AND personnel.active = 1";
    //Prepare Statement
    $statement = $dbConn->prepare($query);
    //Bind parameter to query
    $statement->bindValue(':id', intval(getDivisionIDFromDivisionName($division)['divisionID']), PDO::PARAM_INT);
    //Execute, throw exception if query fails
    if(!$statement->execute()) throw new Exception("Query failed: " . $statement->errorInfo()[2] .".");
    //Fetch result
    $result =  $statement->fetchAll(PDO::FETCH_ASSOC);
    for($i = 0; $i < count($result); $i++) {
      $result[$i]['PID'] = str_pad($result[$i]['PID'], 3, "0", STR_PAD_LEFT);
      if($result[$i]['active'] == 1) $result[$i]['active'] = "Yes";
      else if($result[$i]['active'] == 0) $result[$i]['active'] = "No";
      if($result[$i]['accessRights'] == 1) $result[$i]['accessRights'] = "Yes";
      else if($result[$i]['accessRights'] == 0) $result[$i]['accessRights'] = "No";
      $result[$i]['generationID'] = getGenerationNameFromGenerationID($result[$i]['generationID'])['generationName'];
      $result[$i]['rankID'] = getRankNameFromRankID($result[$i]['rankID'])['rankName'];
      $result[$i]['divisionID'] = getDivisionNameFromDivisionID($result[$i]['divisionID'])['divisionName'];
      $result[$i]['batchID'] = str_pad($result[$i]['batchID'], 3, "0", STR_PAD_LEFT);
    }
    return $result;
  }

  //Get's a Personnel by Rank
  function getPersonnelByRank($rank) {
    //Use Database Connection variable in registrarRequest
    global $dbConn;
    //Prepare query
    $query = "SELECT personnel.PID AS PID, personnel.active AS active, personnel.accessrights AS accessRights, personnel.joindate AS joinDate, personnel.generationID AS generationID, personnel.rankID AS rankID, personnel.divisionID AS divisionID, personnel.batchID AS batchID FROM personnel WHERE personnel.rankID = :id AND personnel.active = 1";
    //Prepare Statement
    $statement = $dbConn->prepare($query);
    //Bind parameter to query
    $statement->bindValue(':id', intval(getRankIDFromRankName($rank)['rankID']), PDO::PARAM_INT);
    //Execute, throw exception if query fails
    if(!$statement->execute()) throw new Exception("Query failed: " . $statement->errorInfo()[2] .".");
    //Fetch result
    $result =  $statement->fetchAll(PDO::FETCH_ASSOC);
    for($i = 0; $i < count($result); $i++) {
      $result[$i]['PID'] = str_pad($result[$i]['PID'], 3, "0", STR_PAD_LEFT);
      if($result[$i]['active'] == 1) $result[$i]['active'] = "Yes";
      else if($result[$i]['active'] == 0) $result[$i]['active'] = "No";
      if($result[$i]['accessRights'] == 1) $result[$i]['accessRights'] = "Yes";
      else if($result[$i]['accessRights'] == 0) $result[$i]['accessRights'] = "No";
      $result[$i]['generationID'] = getGenerationNameFromGenerationID($result[$i]['generationID'])['generationName'];
      $result[$i]['rankID'] = getRankNameFromRankID($result[$i]['rankID'])['rankName'];
      $result[$i]['divisionID'] = getDivisionNameFromDivisionID($result[$i]['divisionID'])['divisionName'];
      $result[$i]['batchID'] = str_pad($result[$i]['batchID'], 3, "0", STR_PAD_LEFT);
    }
    return $result;
  }

  //Get's a Personnel by Batch
  function getPersonnelByBatch($batch) {
    //Use Database Connection variable in registrarRequest
    global $dbConn;
    //Prepare query
    $query = "SELECT personnel.PID AS PID, personnel.active AS active, personnel.accessrights AS accessRights, personnel.joindate AS joinDate, personnel.generationID AS generationID, personnel.rankID AS rankID, personnel.divisionID AS divisionID, personnel.batchID AS batchID FROM personnel WHERE personnel.batchID = :batch AND personnel.active = 1";
    //Prepare Statement
    $statement = $dbConn->prepare($query);
    //Bind parameter to query
    $statement->bindValue(':batch', intval($batch), PDO::PARAM_INT);
    //Execute, throw exception if query fails
    if(!$statement->execute()) throw new Exception("Query failed: " . $statement->errorInfo()[2] .".");
    //Fetch result
    $result =  $statement->fetchAll(PDO::FETCH_ASSOC);
    for($i = 0; $i < count($result); $i++) {
      $result[$i]['PID'] = str_pad($result[$i]['PID'], 3, "0", STR_PAD_LEFT);
      if($result[$i]['active'] == 1) $result[$i]['active'] = "Yes";
      else if($result[$i]['active'] == 0) $result[$i]['active'] = "No";
      if($result[$i]['accessRights'] == 1) $result[$i]['accessRights'] = "Yes";
      else if($result[$i]['accessRights'] == 0) $result[$i]['accessRights'] = "No";
      $result[$i]['generationID'] = getGenerationNameFromGenerationID($result[$i]['generationID'])['generationName'];
      $result[$i]['rankID'] = getRankNameFromRankID($result[$i]['rankID'])['rankName'];
      $result[$i]['divisionID'] = getDivisionNameFromDivisionID($result[$i]['divisionID'])['divisionName'];
      $result[$i]['batchID'] = str_pad($result[$i]['batchID'], 3, "0", STR_PAD_LEFT);
    }
    return $result;
  }

//Get's a Personnel by Division
  function getPersonnelByActive($value) {
    if($value == "active") $status = 1;
    else if($value == "inactive") $status = 0;
    else die("Invalid Active Value");
    //Use Database Connection variable in registrarRequest
    global $dbConn;
    //Prepare query
    $query = "SELECT personnel.PID AS PID, personnel.active AS active, personnel.accessrights AS accessRights, personnel.joindate AS joinDate, personnel.generationID AS generationID, personnel.rankID AS rankID, personnel.divisionID AS divisionID, personnel.batchID AS batchID FROM personnel WHERE personnel.active = :status";
    //Prepare Statement
    $statement = $dbConn->prepare($query);
    //Bind parameter to query
    $statement->bindValue(':status', intval($status), PDO::PARAM_INT);
    //Execute, throw exception if query fails
    if(!$statement->execute()) throw new Exception("Query failed: " . $statement->errorInfo()[2] .".");
    //Fetch result
    $result =  $statement->fetchAll(PDO::FETCH_ASSOC);
    for($i = 0; $i < count($result); $i++) {
      $result[$i]['PID'] = str_pad($result[$i]['PID'], 3, "0", STR_PAD_LEFT);
      if($result[$i]['active'] == 1) $result[$i]['active'] = "Yes";
      else if($result[$i]['active'] == 0) $result[$i]['active'] = "No";
      if($result[$i]['accessRights'] == 1) $result[$i]['accessRights'] = "Yes";
      else if($result[$i]['accessRights'] == 0) $result[$i]['accessRights'] = "No";
      $result[$i]['generationID'] = getGenerationNameFromGenerationID($result[$i]['generationID'])['generationName'];
      $result[$i]['rankID'] = getRankNameFromRankID($result[$i]['rankID'])['rankName'];
      $result[$i]['divisionID'] = getDivisionNameFromDivisionID($result[$i]['divisionID'])['divisionName'];
      $result[$i]['batchID'] = str_pad($result[$i]['batchID'], 3, "0", STR_PAD_LEFT);
    }
    return $result;
  }

  //Get's a Personnel by Generation
  function getPersonnelByGeneration($generation) {
    //Use Database Connection variable in registrarRequest
    global $dbConn;
    //Prepare query
    $query = "SELECT personnel.PID AS PID, personnel.active AS active, personnel.accessrights AS accessRights, personnel.joindate AS joinDate, personnel.generationID AS generationID, personnel.rankID AS rankID, personnel.divisionID AS divisionID, personnel.batchID AS batchID FROM personnel WHERE personnel.generationID = :id AND personnel.active = 1";
    //Prepare Statement
    $statement = $dbConn->prepare($query);
    //Bind parameter to query
    $statement->bindValue(':id', intval(getGenerationIDFromGenerationName($generation)['generationID']), PDO::PARAM_INT);
    //Execute, throw exception if query fails
    if(!$statement->execute()) throw new Exception("Query failed: " . $statement->errorInfo()[2] .".");
    //Fetch result
    $result =  $statement->fetchAll(PDO::FETCH_ASSOC);
    for($i = 0; $i < count($result); $i++) {
      $result[$i]['PID'] = str_pad($result[$i]['PID'], 3, "0", STR_PAD_LEFT);
      if($result[$i]['active'] == 1) $result[$i]['active'] = "Yes";
      else if($result[$i]['active'] == 0) $result[$i]['active'] = "No";
      if($result[$i]['accessRights'] == 1) $result[$i]['accessRights'] = "Yes";
      else if($result[$i]['accessRights'] == 0) $result[$i]['accessRights'] = "No";
      $result[$i]['generationID'] = getGenerationNameFromGenerationID($result[$i]['generationID'])['generationName'];
      $result[$i]['rankID'] = getRankNameFromRankID($result[$i]['rankID'])['rankName'];
      $result[$i]['divisionID'] = getDivisionNameFromDivisionID($result[$i]['divisionID'])['divisionName'];
      $result[$i]['batchID'] = str_pad($result[$i]['batchID'], 3, "0", STR_PAD_LEFT);
    }
    return $result;
  }

    function getNextBatch() {
    global $dbConn;
    //Prepare query
    $query = "SELECT MAX(batchID) AS batch FROM personnel;";
    //Prepare Statement
    $statement = $dbConn->prepare($query);
    //Execute, throw exception if query fails
    if(!$statement->execute()) throw new Exception("Query failed.");
    //Fetch result
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    //Return array
    return $result['batch'] + 1;
  }
?>