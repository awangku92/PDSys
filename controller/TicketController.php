<?php

require __DIR__ . '/../util/db.php';
require __DIR__ . '/../util/config.php';

class TicketController {

    public function getAllTicket (){
        $db = new db();
        $ticket = new stdClass();

        $conn = $db->connect();

        $sql  = "SELECT * FROM ticket";

        $stmt = $conn->prepare($sql);
        //$stmt->bind_param("ss", $email, $password);

        /* execute query */
        $stmt->execute();       

        /* instead of bind_result */
        $result = $stmt->get_result(); 

        /* now you can fetch the results into an array - NICE */
        while( $row = $result->fetch_assoc() ) {
          $ticket = new ticket($row["UID"], $row["TicketID"], $row["SearchID"], $row["DateTime"], $row["BranchID"], $row["CategoryID"], $row["StatusID"], $row["Detail"], $row["UIDContractor"]);
        }

        //$_SESSION["user"] = $user;

        $stmt->close();
        $conn->close();

        return $ticket;
    }
}

?>
