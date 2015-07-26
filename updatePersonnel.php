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

  function updateKD($pid, $kills, $deaths) {
    global $dbConn;
    //Prepare query
    $query = "UPDATE personnel SET kills=kills + :kills, deaths=deaths + :deaths WHERE PID=:pid;";
    //Prepare Statement
    $statement = $dbConn->prepare($query);
    //Bind parameter to query
    $statement->bindValue(':pid', intval($pid), PDO::PARAM_INT);
    //Bind parameter to query
    $statement->bindValue(':kills', intval($kills), PDO::PARAM_INT);
    //Bind parameter to query
    $statement->bindValue(':deaths', intval($deaths), PDO::PARAM_INT);
    //Execute, throw exception if query fails
    if(!$statement->execute()) throw new Exception("Query failed: " . $statement->errorInfo()[2] .".");
  }
?>