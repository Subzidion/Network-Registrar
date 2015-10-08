<?php
  //Get's a Accounts from PID
  function getAccountsFromPID($pid) {
    //Use Database Connection variable in registrarRequest
    global $dbConn;
    //Prepare query
    $query = "SELECT accounts.PID AS PID, accounts.UUID AS UUID, accounts.alt AS alt, accounts.username AS username, accounts.displayname AS displayName FROM accounts WHERE accounts.PID = :id";
    //Prepare Statement
    $statement = $dbConn->prepare($query);
    //Bind parameter to query
    $statement->bindValue(':id', intval($pid), PDO::PARAM_INT);
    //Execute, throw exception if query fails
    if(!$statement->execute()) throw new Exception("Query failed: " . $statement->errorInfo()[2] .".");
    //Fetch result
    $result =  $statement->fetchAll(PDO::FETCH_ASSOC);
    for($i = 0; $i < count($result); $i++) {
      $result[$i]['PID'] = str_pad($result[$i]['PID'], 3, "0", STR_PAD_LEFT);
      if($result[$i]['alt'] == 1) $result[$i]['active'] = "Yes";
      else if($result[$i]['alt'] == 0) $result[$i]['active'] = "No";
    }
    return $result;
  }

  //Get's a Accounts from Division
  function getAccountsFromDivision($username) {
    return getAccountsFromPID(getPIDFromUsername($username));
  }

  //Get's a Accounts from UUID
  function getAccountsFromUUID($UUID) {
    return getAccountsFromPID(getPIDFromUUID($UUID));
  }

?>