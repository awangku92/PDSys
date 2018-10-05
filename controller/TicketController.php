<?php

require_once __DIR__ . '/../util/db.php';
require_once __DIR__ . '/../util/config.php';


class TicketController {
    public function getAllTicket (){
        $db = new db();

        $conn = $db->connect();

        $sql  = "SELECT * FROM ticket ORDER BY StatusID DESC, TicketID DESC";

        $stmt = $conn->prepare($sql);
        //$stmt->bind_param("ss", $email, $password);

        /* execute query */
        $stmt->execute();       

        /* instead of bind_result */
        $result = $stmt->get_result(); 

        $stmt->close();
        $conn->close();

        return $result;
    }

    public function getTickets ($UIDContractor){
        $db = new db();

        $conn = $db->connect();

        $sql  = "SELECT * FROM ticket WHERE UIDContractor = ? ORDER BY StatusID DESC, TicketID DESC";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $UIDContractor);

        /* execute query */
        $stmt->execute();       

        /* instead of bind_result */
        $result = $stmt->get_result(); 

        $stmt->close();
        $conn->close();

        return $result;
    }

    public function getStatus($statusID){
        $db = new db();

        $conn = $db->connect();

        $sql  = "SELECT StatusDetail FROM status WHERE StatusID = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $statusID);

        /* execute query */
        $stmt->execute();       

        /* Store the result (to get properties) */
        $stmt->store_result();

        /* Bind the result to variables */
        $stmt->bind_result($StatusDetail);

        while ($stmt->fetch()){
            //var_dump($StatusDetail);
        }

        /* free results */
        $stmt->free_result();

        $stmt->close();
        $conn->close();

        return $StatusDetail;
    }

    public function getStatusID($status){
        $db = new db();

        $conn = $db->connect();

        $sql  = "SELECT StatusID FROM status WHERE StatusDetail = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $status);

        /* execute query */
        $stmt->execute();       

        /* Store the result (to get properties) */
        $stmt->store_result();

        /* Bind the result to variables */
        $stmt->bind_result($StatusDetail);

        while ($stmt->fetch()){
            //var_dump($StatusDetail);
        }

        /* free results */
        $stmt->free_result();

        $stmt->close();
        $conn->close();

        return $StatusDetail;
    }

    public function getCategoryType ($categoryID){
        $db = new db();

        $conn = $db->connect();

        $sql  = "SELECT CategoryType FROM category WHERE CategoryID = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $categoryID);

        /* execute query */
        $stmt->execute();       

        /* Store the result (to get properties) */
        $stmt->store_result();

        /* Bind the result to variables */
        $stmt->bind_result($CategoryType);

        while ($stmt->fetch()){
            //var_dump($StatusDetail);
        }

        /* free results */
        $stmt->free_result();

        $stmt->close();
        $conn->close();

        return $CategoryType;
    }

    public function getAllCategory(){
        $db = new db();

        $conn = $db->connect();

        $sql  = "SELECT * FROM category";

        $stmt = $conn->prepare($sql);
        //$stmt->bind_param("ss", $email, $password);

        /* execute query */
        $stmt->execute();       

        /* instead of bind_result */
        $result = $stmt->get_result(); 

        $stmt->close();
        $conn->close();

        return $result;
    }

    public function generateTicketId($userID){

        $db = new db();

        $conn = $db->connect();

        $sql = "SELECT * FROM ticket WHERE UID = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $userID);

        $stmt->execute();

        $totalTicket = 1;

        while ($stmt->fetch()){
            $totalTicket++;
        }
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $date = date("Ymd");
        $time = date("hi");

        $stmt->close();
        $conn->close();
        
        return $date."_".$time."_TIC".$totalTicket;
    }

    public function openTicket($ticketID, $userID, $dateTime, $state, $categoryID, $statusID, $detail, $uIDContractor){
        $sqlTicket = "";
        $db = new db();

        $conn = $db->connect();

        //insert into ticket
        $sqlTicket = "INSERT INTO ticket (TicketID, UID, DateTime, State, CategoryID, StatusID, Detail, UIDContractor) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmtTicket = $conn->prepare($sqlTicket);

        $test = $stmtTicket->bind_param("sisssssi", $ticketID, $userID, $dateTime, $state, $categoryID, $statusID, $detail, $uIDContractor);

        $resultTicket = $stmtTicket->execute();

        $stmtTicket->close();
        $conn->close();

        if ($resultTicket){
            return True;
        }else{
            return False;
        }
    }

    public function logTickets($ticketID, $userID, $dateTime, $statusID, $uIDContractor, $postponeDateTime, $reason){
        $sqlLogTickets = "";
        $db = new db();

        $conn = $db->connect();
        //insert into logtickets
        $sqlLogTickets = "INSERT INTO logtickets (TicketID, UID, DateTime, PostponeDateTime, StatusID, Reason, UIDContractor) VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmtLogTickets = $conn->prepare($sqlLogTickets);

        $stmtLogTickets->bind_param("sissssi", $ticketID, $userID, $dateTime, $postponeDateTime, $statusID, $reason, $uIDContractor);

        $resultLogTickets = $stmtLogTickets->execute();

        $stmtLogTickets->close();
        $conn->close();

        if ($resultLogTickets){
            return True;
        }else{
            return False;
        }
    }

    public function closeTicket($ticketID, $statusID) {
        $sqlCloseTicket = "";
        $db = new db();

        $conn = $db->connect();

        //insert into logtickets
        //$sqlCloseTicket = "INSERT INTO logtickets (TicketID, UID, DateTime, PostponeDateTime, StatusID, Reason, UIDContractor) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $sqlCloseTicket = "UPDATE ticket SET StatusID = ? WHERE TicketID = ?";

        $stmtCloseTicket = $conn->prepare($sqlCloseTicket);

        $stmtCloseTicket->bind_param("ss", $statusID, $ticketID);

        $resulCloseTicket = $stmtCloseTicket->execute();

        $stmtCloseTicket->close();
        $conn->close();

        if ($resulCloseTicket){
            return True;
        }else{
            return False;
        }
    }

    public function getAppoimentDateTime($ticketID){
        $db = new db();

        $conn = $db->connect();

        $sql  = "SELECT MAX(PostponeDateTime) FROM logtickets WHERE TicketID = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $ticketID);

        /* execute query */
        $stmt->execute();       

        /* Store the result (to get properties) */
        $stmt->store_result();

        /* Bind the result to variables */
        $stmt->bind_result($DateTime);

        while ($stmt->fetch()){
            //var_dump($StatusDetail);
        }

        /* free results */
        $stmt->free_result();

        $stmt->close();
        $conn->close();

        return $DateTime;
    }

    public function updateTicketUID($ticketID, $UIDContractor) {
        $sql = "";
        $db = new db();

        $conn = $db->connect();

        //update UID
        $sql = "UPDATE ticket SET UIDContractor = ? WHERE TicketID = ?";

        $stmt = $conn->prepare($sql);

        $stmt->bind_param("is", $UIDContractor, $ticketID);

        $result = $stmt->execute();

        $stmt->close();
        $conn->close();

        if ($result){
            return True;
        }else{
            return False;
        }
    }

    // public function getTicketContractor($contractorID){        
 
    //     $sql = "SELECT UID, FullName, Contact FROM user WHERE UID = ?";

    //     $db = new db();
    //     $conn = $db->connect();
    //     $stmt = $conn->prepare($sql);
    //     $stmt->bind_param("i",$contractorID);

    //     $stmt->execute();

    //     $stmt->bind_result($UID, $FullName, $Contact);

    //     $result = array();

    //     if($stmt->fetch()) {
    //         $result = array('UID'=>$UID, 'FullName'=>$FullName, 'Contact'=>$Contact);
    //     }

    //     $stmt->close();
    //     $conn->close();

    //     return $result;
    // }

    public function getTicketContractor($ticketID){
        $sql = "SELECT UIDContractor FROM ticket WHERE TicketID = ?";

        $db = new db();
        $conn = $db->connect();
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s",$ticketID);

        $stmt->execute();

        $stmt->bind_result($UIDContractor);

        //$result = array();

        if($stmt->fetch()) {
            //$result = array('UIDContractor'=>$UIDContractor);
        }

        $stmt->close();
        $conn->close();

        return $UIDContractor;
    }

    public function updateTicketStatus($ticketID, $statusID) {
        $sql = "";
        $db = new db();

        $conn = $db->connect();

        //update UID
        $sql = "UPDATE ticket SET StatusID = ? WHERE TicketID = ?";

        $stmt = $conn->prepare($sql);

        $stmt->bind_param("ss", $statusID, $ticketID);

        $result = $stmt->execute();

        $stmt->close();
        $conn->close();

        if ($result){
            return True;
        }else{
            return False;
        }
    }

    
    public function getIncompleteReason($ticketID){
        $db = new db();

        $conn = $db->connect();

        $sql  = "SELECT Reason FROM logtickets WHERE StatusID = 'IC' AND TicketID = ? ";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $ticketID);

        /* execute query */
        $stmt->execute();       

        /* Store the result (to get properties) */
        $stmt->store_result();

        /* Bind the result to variables */
        $stmt->bind_result($Reason);
        //var_dump($Reason);

        while ( $stmt->fetch() ){
            //var_dump($Reason);
        }

        /* free results */
        $stmt->free_result();

        $stmt->close();
        $conn->close();

        return $Reason;
    }

}

?>
