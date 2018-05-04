<?php

require __DIR__ . '/../util/db.php';
require __DIR__ . '/../util/config.php';


class TicketController {
    public function getAllTicket (){
        $db = new db();

        $conn = $db->connect();

        $sql  = "SELECT * FROM ticket";

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
        $status = new stdClass();

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

    public function getCategory ($categoryID){
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
        $stmt->bind_result($Category);

        while ($stmt->fetch()){
            //var_dump($StatusDetail);
        }

        /* free results */
        $stmt->free_result();

        $stmt->close();
        $conn->close();

        return $Category;
    }

    public function generateTicketId ($userID){

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

    public function openTicket ($ticketID, $userID, $dateTime, $Category , $Details){
        return "Okey";
    }
}

?>
