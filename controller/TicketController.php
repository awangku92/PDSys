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
}

?>
