<?php

class UserController {

	public function login ($username, $password){

		$db = new db();
    $user = new stdClass();

		$conn = $db->connect();

		$sql  = "SELECT * FROM user WHERE Username = ? AND Password = ? AND UserStatus = 1";

		$stmt = $conn->prepare($sql);
		$stmt->bind_param("ss", $username, $password);

		/* execute query */
    $stmt->execute();    	

    /* instead of bind_result */
    $result = $stmt->get_result();    	

    if($result->num_rows === 0) {
      $stmt->close();
      $conn->close();
      header("Location: /PdagangSystem/");
      die();
    }

    /* now you can fetch the results into an array - NICE */
    while( $row = $result->fetch_assoc() ) {
      $user = new user($row["UID"], $row["Username"], $row["Password"], $row["UserType"], $row["CompanyName"], $row["CompAddress1"], $row["CompAddress2"], $row["Postcode"], $row["State"], $row["Region"], $row["FullName"], $row["UserStatus"], $row["Contact"]);
    }

    $_SESSION["user"] = $user;

    $stmt->close();
    $conn->close();

    return $user->getUserType();
  }

  public function register ($usertype, $fullname, $contactno, $companyname, $compaddr1, $compaddr2, $state, $postalcode, $region, $username, $password){

    $sql = "";
    $db = new db();

    $conn = $db->connect();

    if ($usertype === "C" || $usertype === "D"){
      $sql = "INSERT INTO user (Username, Password, UserType, CompanyName, CompAddress1, CompAddress2, Postcode, State, Region, FullName, Contact) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    } else if ($usertype === "HQ"){
      $sql = "INSERT INTO user (Username, Password, UserType,FullName, Contact) VALUES (?, ?, ?, ?, ?)";
    }

    $stmt = $conn->prepare($sql);

    if ($usertype === "C" or $usertype === "D"){
      $stmt->bind_param("ssssssissss", $username, $password, $usertype, $companyname, $compaddr1, $compaddr2, $postalcode, $state, $region, $fullname, $contact);
    } else if ($usertype === "HQ"){
      $stmt->bind_param("sssss", $username, $password, $usertype, $fullname, $contact);
    }

    $stmt->execute();

    $stmt->close();
    $conn->close();
  }
}

?>