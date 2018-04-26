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

        /* instead of bind_result */
        $result = $stmt->get_result(); 

        //$status = new status($result["StatusDetail"]);
        //binding object to string

        var_dump($status);
        var_dump($result);

        $stmt->close();
        $conn->close();

        //return $status->getStatusDetail();
    }
}

?>
