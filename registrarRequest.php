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
    include "updatePersonnel.php";
    include "Rating.php";
    include "getCombat.php";
    include "testGetters.php";
  //

  function errorReport($message) {
    die(json_encode("ERROR: " . $message));
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
  try {
    //Request Types
      //Get Personnel ID of a UUID or username
      if($_POST['request'] == "PID") {
        //UUID -> PID
        if(isset($_POST['UUID'])) die(json_encode(str_pad(getPIDFromUUID($_POST['UUID'])['PID'], 3, "0", STR_PAD_LEFT)));
        //Username -> PID
        if(isset($_POST['username'])) die(json_encode(str_pad(getPIDFromUsername($_POST['username'])['PID'], 3, "0", STR_PAD_LEFT)));
        else die(json_encode(array("Invalid Parameters. Usage: request=\"PID\" must include a UUID or username parameter.")));
      }

      else if($_POST['request'] == "combat") die(json_encode(array_values(getKD(getPID()))));

      else if($_POST['request'] == "leaderboard") {
        if(!(isset($_POST['type'])) || !(isset($_POST['limit']))) throw new Exception("Invalid parameters.");
        $results = getLeaderboard($_POST['type'], $_POST['limit']);
        for($i = 0; $i < count($results); $i++) $results[$i] = array_values($results[$i]);
        die(json_encode(array_values($results)));
      }

      else if($_POST['request'] == "updateElo") {
        if(!(isset($_POST['winner'])) || !(isset($_POST['loser']))) throw new Exception ("Invalid parameters");
        else {
          updateElo(getPIDFromUUID($_POST['winner']), getPIDFromUUID($_POST['loser']));
        }
      }

      //Promote or Demote to RankID or RankName Personnel based on UUID, username, or PID
      else if($_POST['request'] == "updateRank") {
        //Get User PID from Username, UUID, or PID
        $targetPID = getPID();
        //RankID
        if(isset($_POST['rankID'])) $targetRank = $_POST['rankID'];
        //Rank Name -> RankID
        else if(isset($_POST['rankName'])) $targetRank = getRankIDFromRankName($_POST['rankName'])['rankID'];
        //Invalid Parameters
        else die(json_encode(array("Invalid Parameters. Usage: request=\"updateRank\" must include a UUID or username or PID parameter.")));
        //Change Rank
        updateRank($targetPID, $targetRank);
      }

      //Promote or Demote to RankID or RankName Personnel based on UUID, username, or PID
      else if($_POST['request'] == "updateActive") {
        //Update Active
        updateActive(getPID());
      }

      else if($_POST['request'] == "updateKD") {
        if(!isset($_POST['kills']) || !isset($_POST['deaths'])) die(json_encode(array("Invalid Parameters. Usage: request=\"updateKD\" must include a UUID, kills, and deaths parameters.")));
        updateKD(getPID(), $_POST['kills'], $_POST['deaths']);
      }

      else if($_POST['request'] == "rank") {
        if(!isset($_POST['type'])) die(json_encode("Invalid Parameters. Usage: request=\"rank\" must include a Type parameter."));
        if($_POST['type'] == "all") {
          //Get all of specific rnak
        }
        else if($_POST['type'] == "user") die(json_encode(getRankNameFromPID(getPID())['rankName']));
      }

      //Get Rank Patch for UUID, username, PID
      else if($_POST['request'] == "rankPatch") die(json_encode(getRankInsigniaFromRankName(getRankNameFromPID(getPID())['rankName'])['rankInsignia']));

      //Get Account Information by UUID, username, PID
      else if($_POST['request'] == "accounts") {
        if(!isset($_POST['type'])) die(json_encode("Invalid Parameters. Usage: request=\"accounts\" must include a Type parameter."));
      else {
          //All known Accounts
          if($_POST['type'] == "alts") {
            //Get User PID from Username, UUID, or PID
            $targetPID = getPID();

          }
          //Main Account
          if($_POST['type'] == "main") {
            //Get User PID from Username, UUID, or PID
            $targetPID = getPID();
            
          }
        }
      }

      //Get Personnel by Rank, Division, Batch, Active, Generation, PID, Username, UUID
      else if($_POST['request'] == "personnel") {
        if($_POST['type'] == "user") die(json_encode(array_values(getPersonnelByPID(getPID()))));
        else if($_POST['type'] == "division") {
          $results = getPersonnelByDivision($_POST['division']);
          for($i = 0; $i < count($results); $i++) $results[$i] = array_values($results[$i]);
          die(json_encode(array_values($results)));
        }
        else if($_POST['type'] == "rank") {
          $results = getPersonnelByRank($_POST['rank']);
          for($i = 0; $i < count($results); $i++) $results[$i] = array_values($results[$i]);
          die(json_encode(array_values($results)));
        }
        else if($_POST['type'] == "batch") {
          $results = getPersonnelByBatch($_POST['batch']);
          for($i = 0; $i < count($results); $i++) $results[$i] = array_values($results[$i]);
          die(json_encode(array_values($results)));
        }
        else if($_POST['type'] == "generation") {
          $results = getPersonnelByGeneration($_POST['value']);
          for($i = 0; $i < count($results); $i++) $results[$i] = array_values($results[$i]);
          die(json_encode(array_values($results)));
        }
        else if($_POST['type'] == "active") {
          $results = getPersonnelByActive($_POST['value']);
        for($i = 0; $i < count($results); $i++) $results[$i] = array_values($results[$i]);
        die(json_encode(array_values($results)));
        }
      }
      //Get Personnel by Rank, Division, Batch, Active, Generation, PID, Username, UUID
      //Get Main or ALL accounts associated with each of those personnel
      else if($_POST['request'] == "full") {

      }
    //

      //Query a Node or information about a Node
      else if($_POST['request'] == "node") {
        //Return a report on the node
        if($_POST['type'] == "information") {

        }
        //Gets the current users in a sim
        if($_POST['type'] == "current") {

        }
      }

      else if($_POST['request'] == "test") {
        die(json_encode(array_values(getPersonnelByPID(30))));
      }
    } catch(Exception $e) {
      die(errorReport($e->getMessage()));
    }
?>