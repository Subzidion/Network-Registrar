<?php
    function addUser($pid, $alt, $uuid, $username, $displayName) {
    global $dbConn;
    //Prepare query
    $query = "INSERT INTO accounts  VALUES(NULL, :pid, :uuid, :alt, :username, :displayName);";
    //Prepare Statement
    $statement = $dbConn->prepare($query);
    //Bind parameter to query
    $statement->bindValue('pid', $pid, PDO::PARAM_INT);
    $statement->bindValue('alt', $alt, PDO::PARAM_INT);
    $statement->bindValue('uuid', $uuid, PDO::PARAM_STR);
    $statement->bindValue('username', $username, PDO::PARAM_STR);
    $statement->bindValue('displayName', $displayName, PDO::PARAM_STR);
    //Execute, throw exception if query fails
    if(!$statement->execute()) throw new Exception("Query failed: " . $statement->errorInfo()[2] .".");
  }
?>