<?php

require_once __DIR__ . '/../util/db.php';
require_once __DIR__ . '/../util/config.php';


class TicketController {
    public function getAllTicket (){
        $db = new db();

        $conn = $db->connect();

        $sql  = "SELECT * FROM ticket ORDER BY StatusID DESC";

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

    public function getState ($branchID){
        $db = new db();

        $conn = $db->connect();

        $sql  = "SELECT State FROM branches WHERE BranchesID = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $branchID);

        /* execute query */
        $stmt->execute();       

        /* Store the result (to get properties) */
        $stmt->store_result();

        /* Bind the result to variables */
        $stmt->bind_result($State);

        while ($stmt->fetch()){
            //var_dump($StatusDetail);
        }

        /* free results */
        $stmt->free_result();

        $stmt->close();
        $conn->close();

        return $State;
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

    public function getBranchID ($userID, $state){
        $db = new db();

        $conn = $db->connect();

        $sql  = "SELECT BranchesID FROM branches WHERE UID = ? AND State = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $userID, $state);

        /* execute query */
        $stmt->execute();       

        /* Store the result (to get properties) */
        $stmt->store_result();

        /* Bind the result to variables */
        $stmt->bind_result($BranchID);

        while ($stmt->fetch()){
            //var_dump($StatusDetail);
        }

        /* free results */
        $stmt->free_result();

        $stmt->close();
        $conn->close();

        return $BranchID;
    }

    public function openTicket($ticketID, $userID, $dateTime, $branchID, $categoryID, $statusID, $detail, $uIDContractor){
        $sqlTicket = "";
        $db = new db();

        $conn = $db->connect();

        //insert into ticket
        $sqlTicket = "INSERT INTO ticket (TicketID, UID, DateTime, BranchID, CategoryID, StatusID, Detail, UIDContractor) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmtTicket = $conn->prepare($sqlTicket);

        $test = $stmtTicket->bind_param("sisssssi", $ticketID, $userID, $dateTime, $branchID, $categoryID, $statusID, $detail, $uIDContractor);

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
        //var_dump($postponeDateTime);
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


    // public function getCategoryID ($categoryType){
    //     $db = new db();

    //     $conn = $db->connect();

    //     $sql  = "SELECT CategoryID FROM category WHERE CategoryType = ?";

    //     $stmt = $conn->prepare($sql);
    //     $stmt->bind_param("s", $categoryType);

    //     /* execute query */
    //     $stmt->execute();       

    //     /* Store the result (to get properties) */
    //     $stmt->store_result();

    //     /* Bind the result to variables */
    //     $stmt->bind_result($CategoryID);

    //     while ($stmt->fetch()){
    //         //var_dump($StatusDetail);
    //     }

    //     /* free results */
    //     $stmt->free_result();

    //     $stmt->close();
    //     $conn->close();

    //     return $CategoryID;
    // }
}

?>
