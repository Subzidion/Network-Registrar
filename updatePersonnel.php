<?php
  function updateRank($pid, $rank) {
    global $dbConn;
    //Prepare query
    $query = "UPDATE personnel SET rankID=:rank WHERE PID=:pid;";
    //Prepare Statement
    $statement = $dbConn->prepare($query);
    //Bind parameter to query
    $statement->bindValue(':pid', intval($pid), PDO::PARAM_INT);
    //Bind parameter to query
    $statement->bindValue(':rank', intval($rank), PDO::PARAM_INT);
    //Execute, throw exception if query fails
    if(!$statement->execute()) throw new Exception("Query failed: " . $statement->errorInfo()[2] .".");
  }

  function updateActive($pid) {
    global $dbConn;
    //Prepare query
    $query = "UPDATE personnel SET active = IF(active, 0, 1) WHERE PID=:pid;";
    //Prepare Statement
    $statement = $dbConn->prepare($query);
    //Bind parameter to query
    $statement->bindValue(':pid', intval($pid), PDO::PARAM_INT);
    //Execute, throw exception if query fails
    if(!$statement->execute()) throw new Exception("Query failed: " . $statement->errorInfo()[2] .".");
  }

  function addPersonnel($uuid, $username, $displayName, $joindate, $divisionID, $batchID) {
    global $dbConn;
    //Prepare query
    $query = "INSERT INTO personnel  VALUES(:nextPID, 1, 0, :joindate, 9, 1, :divisionID, :batchID);";
    //Prepare Statement
    $statement = $dbConn->prepare($query);
    //Bind parameter to query
    $pid = getNextAvailablePID();
    $statement->bindValue('nextPID', $pid, PDO::PARAM_INT);
    $statement->bindValue('joindate', $joindate, PDO::PARAM_STR);
    $statement->bindValue('divisionID', $divisionID, PDO::PARAM_INT);
    $statement->bindValue('batchID', $batchID, PDO::PARAM_INT);
    //Execute, throw exception if query fails
    if(!$statement->execute()) throw new Exception("Query failed: " . $statement->errorInfo()[2] .".");
    addUser($pid, 0, $uuid, $username, $displayName);
  }
?>