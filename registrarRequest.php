<?php
  //Includes
    include "../../overwatch/info.php";
    include "../../external_includes/mysql_network_config.php";
    include "getAccessRights.php";
    include "getPID.php";
    include "getGeneration.php";
    include "getUsername.php";
    include "getRank.php";
    include "getDivision.php";
    include "getPersonnel.php";
    include "testGetters.php";
  //

  function errorReport($message) {
    die("ERROR: " . $message);
  }

  function changeRank($pid, $rank) {
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

  //AUTHENTICATE REQUEST
    if(!isset($_POST['key']) || $_POST['key'] !== $secretKey) errorReport("Access denied.");
    if(!isset($_SERVER['HTTP_X_SECONDLIFE_SHARD'])) errorReport("Access denied.");

    //Connect to Database. Need to determine if requesting user is authorized
    try {
      $dbConn = new PDO("mysql:host=$dbServer;dbname=$dbName", $dbUser, $dbPassword);
    } catch(PDOException $e) {
      errorReport("Database connection failed.");
    } 

    //Authenticate User
    $requestUUID = $_SERVER["HTTP_X_SECONDLIFE_OWNER_KEY"];
    try {
      if(getAccessRightsFromUUID($requestUUID)['accessRights'] == 0) errorReport("Access denied.");
    } catch(Exception $e) {
      errorReport($e->getMessage());
    }

  //Request Types
    //Get Personnel ID of a UUID or username
    if($_POST['request'] == "PID") {
      //UUID -> PID
      if(isset($_POST['UUID'])) die(json_encode(str_pad(getPIDFromUUID($_POST['UUID'])['PID'], 3, "0", STR_PAD_LEFT)));
      //Username -> PID
      if(isset($_POST['username'])) die(json_encode(str_pad(getPIDFromUsername($_POST['username'])['PID'], 3, "0", STR_PAD_LEFT)));
      else die(json_encode(array("Invalid Parameters. Usage: request=\"PID\" must include a UUID or username parameter.")));
    }

    //Promote or Demote to RankID or RankName Personnel based on UUID, username, or PID
    else if($_POST['request'] == "changeRank") {
      if(isset($_POST['rankID'])) $targetRank = $_POST['rankID'];
      else if(isset($_POST['rankName'])) $targetRank = getRankIDFromRankName($_POST['rankName'])['rankID'];
      //Promote UUID
      if(isset($_POST['UUID'])) $targetPID = getPIDFromUUID($_POST['UUID'])['PID'];
      else if(isset($_POST['username'])) $targetPID = getPIDFromUsername($_POST['username'])['PID'];
      //Promote PID
      else if(isset($_POST['PID'])) $targetPID = $_POST['PID'];
      else die(json_encode(array("Invalid Parameters. Usage: request=\"changeRank\" must include a UUID or username or PID parameter.")));
      changeRank($targetPID, $targetRank);
    }
    //Get Rank Patch for UUID, username, PID
    else if($_POST['request'] == "rankPatch") {
      //UUID -> Rank Insignia
      //if(isset($_POST['UUID'])) die(json_encode(getRankInsigniaFromID(/* GET PERSONNEL RANK HERE */)['rankInsignia']));
      //else die(json_encode(array("Invalid Parameters. Usage: request=\"rankPatch\" must include a UUID parameter.")))
    }

    //Get Account Information by UUID, username, PID
    else if($_POST['request'] == "accounts") {
      if(!isset($_POST['type'])) die(json_encode("Invalid Parameters. Usage: request=\"accounts\" must include a Type parameter."));
      else {
        //All known Accounts
        if($_POST['type'] == "alts") {
          //UUID -> All Known Accounts' Details
          //if(isset($_POST['UUID'])) 
          //Username -> All Known Accounts' Details
          //if(isset($_POST['UUID']))
        }
        //Main Account
        if($_POST['type'] == "main") {
          //UUID -> Main Account Details
          //if(isset($_POST['UUID']))
          //Username -> Main Account Details
          //if(isset($_POST['UUID']))
        }
      }
    }

    //Get Personnel by Rank, Division, Batch, Active, Generation, PID, Username, UUID
    else if($_POST['request'] == "personnel") {

    }

    //Get Personnel by Rank, Division, Batch, Active, Generation, PID, Username, UUID
    //Get Main or ALL accounts associated with each of those personnel
    else if($_POST['request'] == "full") {

    }
  //

  if($_POST['request'] == "test") {
    die(json_encode(array_values(getPersonnelByPID(29))));
  }

?>    
