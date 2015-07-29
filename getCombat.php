<?php
    function updateKD($pid, $kills, $deaths) {
    global $dbConn;
    //Prepare query
    $query = "UPDATE combat SET kills=kills + :kills, deaths=deaths + :deaths WHERE PID=:pid;";
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

  function getKD($pid) {
    //Use Database Connection variable in registrarRequest
    global $dbConn;
    //Prepare query
    $query = "SELECT combat.PID AS PID, combat.kills AS kills, combat.deaths AS deaths, combat.soloKills AS soloKills, combat.soloDeaths as soloDeaths, combat.Elo AS Elo, combat.captures AS captures, combat.KOTH AS KOTH FROM combat WHERE combat.PID = :id";
    //Prepare Statement
    $statement = $dbConn->prepare($query);
    //Bind parameter to query
    $statement->bindValue(':id', strval($pid), PDO::PARAM_STR);
    //Execute, throw exception if query fails
    if(!$statement->execute()) throw new Exception("Query failed: " . $statement->errorInfo()[2] .".");
    //Fetch result
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    //Return array
    return $result;
  }

  function getLeaderboard($type, $count) {
    //Use Database Connection variable in registrarRequest
    global $dbConn;
    //Prepare query
    if($type == "group")      $query = "SELECT combat.PID AS PID, combat.kills AS kills, combat.deaths AS deaths, combat.soloKills AS soloKills, combat.soloDeaths as soloDeaths, combat.Elo AS Elo, combat.captures AS captures, combat.KOTH AS KOTH FROM combat ORDER BY kills/deaths DESC LIMIT :count";
    else if($type == "duel")  $query = "SELECT combat.PID AS PID, combat.kills AS kills, combat.deaths AS deaths, combat.soloKills AS soloKills, combat.soloDeaths as soloDeaths, combat.Elo AS Elo, combat.captures AS captures, combat.KOTH AS KOTH FROM combat ORDER BY Elo DESC LIMIT :count";
    else if($type == "ctf")   $query = "SELECT combat.PID AS PID, combat.kills AS kills, combat.deaths AS deaths, combat.soloKills AS soloKills, combat.soloDeaths as soloDeaths, combat.Elo AS Elo, combat.captures AS captures, combat.KOTH AS KOTH FROM combat ORDER BY captures DESC LIMIT :count";
    else if($type == "koth")  $query = "SELECT combat.PID AS PID, combat.kills AS kills, combat.deaths AS deaths, combat.soloKills AS soloKills, combat.soloDeaths as soloDeaths, combat.Elo AS Elo, combat.captures AS captures, combat.KOTH AS KOTH FROM combat ORDER BY koth DESC LIMIT :count";
    //Prepare Statement
    $statement = $dbConn->prepare($query);
    //Bind parameter to query
    $statement->bindValue(':count', intval($count), PDO::PARAM_INT);
    //Execute, throw exception if query fails
    if(!$statement->execute()) throw new Exception("Query failed: " . $statement->errorInfo()[2] .".");
    //Fetch result
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    for($i = 0; $i < $count; $i++) {
        $name = getUsernameFromPID($result[$i]['PID'])['username'];
        if(strpos($name, ".") === FALSE) $result[$i]['PID'] = ucfirst($name . " R.");
        else {
            $name = explode(".", $name);
            $result[$i]['PID'] = ucfirst($name[0]) . " " . strToUpper($name[1][0] . ".");
        }
        $result[$i]['kills'] = str_pad($result[$i]['kills'], 4, "0", STR_PAD_LEFT);
        $result[$i]['deaths'] = str_pad($result[$i]['deaths'], 4, "0", STR_PAD_LEFT);
        $result[$i]['soloKills'] = str_pad($result[$i]['soloKills'], 4, "0", STR_PAD_LEFT);
        $result[$i]['soloDeaths'] = str_pad($result[$i]['soloDeaths'], 4, "0", STR_PAD_LEFT);
        $result[$i]['Elo'] = str_pad($result[$i]['Elo'], 4, "0", STR_PAD_LEFT);
        $result[$i]['captures'] = str_pad($result[$i]['captures'], 4, "0", STR_PAD_LEFT);
        $result[$i]['KOTH'] = str_pad($result[$i]['KOTH'], 4, "0", STR_PAD_LEFT);
    }

    //Return array
    return $result;
  }

  function formatLeaderboard($result) {
     //[ [displayname,kills,deaths,solokills,solodeaths,ctf,koth]

  }
?>