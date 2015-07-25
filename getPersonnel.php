<?php
  //Get's a Personnel by PID
  function getPersonnelByPID($pid) {
    //Check parameters as valid
    if(!is_int($pid)) throw new Exception("Invalid Personnel ID.");
    //Use Database Connection variable in registrarRequest
    global $dbConn;
    //Prepare query
    $query = "SELECT personnel.PID AS PID, personnel.active AS active, personnel.accessrights AS accessRights, personnel.joindate AS joinDate, personnel.generationID AS generationID, personnel.rankID AS rankID, personnel.divisionID AS divisionID, personnel.batchID AS batchID, personnel.kills AS kills, personnel.deaths AS deaths FROM personnel WHERE personnel.PID = :pid";
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
  }

  //Get's a Personnel by Rank
  function getPersonnelByRank($rank) {
  }

  //Get's a Personnel by Batch
  function getPersonnelByBatch($batch) {
  }

  //Get's a Personnel by Active
  function getPersonnelByActive($active) {
  }

  //Get's a Personnel by Generation
  function getPersonnelByGeneration($generation) {
  }
?>