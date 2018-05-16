<?php

class UserController {

	public function login ($email, $password){

		$db = new db();
    $user = new stdClass();

		$conn = $db->connect();

		$sql  = "SELECT * FROM user WHERE Email = ? AND Password = ? AND UserStatus = 1";

		$stmt = $conn->prepare($sql);
		$stmt->bind_param("ss", $email, $password);

		/* execute query */
    $stmt->execute();    	

    /* instead of bind_result */
    $result = $stmt->get_result();    	

    //email/password is wrong, return to index.php
    if($result->num_rows === 0) {
      $stmt->close();
      $conn->close();

      //header("Location: /PdagangSystem/");
      $err = "error";
      header("Location: /PDSys/index.php?status=$err");
      die();
    }

    /* now you can fetch the results into an array - NICE */
    while( $row = $result->fetch_assoc() ) {
      $user = new user($row["UID"], $row["Email"], $row["Password"], $row["UserType"], $row["CompanyName"], $row["CompAddress1"], $row["CompAddress2"], $row["Postcode"], $row["State"], $row["Region"], $row["FullName"], $row["UserStatus"], $row["Contact"]);
    }

    $_SESSION["user"] = $user;

    $stmt->close();
    $conn->close();

    return $user->getUserType();
  }

  public function logout (){
    // remove all session variables
    session_unset(); 

    // destroy the session 
    session_destroy(); 
  }

  public function register ($usertype, $fullname, $contactno, $companyname, $compaddr1, $compaddr2, $state, $postalcode, $region, $email, $password){

    $sql = "";
    $db = new db();

    $conn = $db->connect();

    if ($usertype === "C" || $usertype === "D"){
      $sql = "INSERT INTO user (Email, Password, UserType, CompanyName, CompAddress1, CompAddress2, Postcode, State, Region, FullName, Contact) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    } else if ($usertype === "HQ"){
      $sql = "INSERT INTO user (Email, Password, UserType,FullName, Contact) VALUES (?, ?, ?, ?, ?)";
    }

    $stmt = $conn->prepare($sql);

    if ($usertype === "C" or $usertype === "D"){
      $stmt->bind_param("ssssssissss", $email, $password, $usertype, $companyname, $compaddr1, $compaddr2, $postalcode, $state, $region, $fullname, $contactno);
    } else if ($usertype === "HQ"){
      $stmt->bind_param("sssss", $email, $password, $usertype, $fullname, $contactno);
    }

    $stmt->execute();

    $stmt->close();
    $conn->close();
  }

  public function getContractor ($UID){
      $db = new db();
      $contractor = new stdClass();

      $conn = $db->connect();

      $sql  = "SELECT CompanyName, FullName, Contact FROM user WHERE UID = ?";

      $stmt = $conn->prepare($sql);
      $stmt->bind_param("s", $UID);

      /* execute query */
      $stmt->execute();       

      $result = $stmt->get_result();

      //var_dump($result);

      // /* free results */
      $stmt->free_result();

      $stmt->close();
      $conn->close();

      return $result;
  }
}

?>
