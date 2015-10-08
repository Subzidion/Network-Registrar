<?php
  //Get's a Username from a PID
  function getEquipmentFromPID($pid) {
    if($pid !== 0) {
        //Check parameters as valid
        $pid = intval($pid);
        //Use Database Connection variable in registrarRequest
        global $dbConn;
        //Prepare query
        $query = "SELECT personnel.rankID AS rankID, personnel.divisionID AS divisionID FROM personnel WHERE personnel.PID = :id";
        //Prepare Statement
        $statement = $dbConn->prepare($query);
        //Bind parameter to query
        $statement->bindValue(':id', intval($pid), PDO::PARAM_INT);
        //Execute, throw exception if query fails
        if(!$statement->execute()) throw new Exception("Query failed.");
        //Fetch result
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $divisionID = $result['divisionID'];
        $rankID = $result['rankID'];
        $query = "SELECT equipment.name AS name, equipment.description AS description FROM equipment WHERE (:division = 4) OR (equipment.rankReq <= :rank AND equipment.divisionReq = 0 AND equipment.active = 1) OR (equipment.rankReq = 0 AND equipment.divisionReq = :division AND equipment.active = 1) OR (equipment.rankReq <= :rank AND equipment.divisionReq = :division AND equipment.active = 1)";
        $statement = $dbConn->prepare($query);
        $statement->bindValue(':rank', intval($result['rankID']), PDO::PARAM_INT);
        $statement->bindValue(':division', intval($result['divisionID']), PDO::PARAM_INT);
        if(!$statement->execute()) throw new Exception("Query failed!");
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        //Return array
        return $result;
    }
    return array();
  }
?>