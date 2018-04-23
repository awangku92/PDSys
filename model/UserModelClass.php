<?php

class User {

	var $UID, $Email, $Password, $UserType, $CompanyName, $CompAddress1, $CompAddress2, $Postcode, $State, $Region, $FullName, $UserStatus, $Contact;

	public function __construct($UID, $Email, $Password, $UserType, $CompanyName, $CompAddress1, $CompAddress2, $Postcode, $State, $Region, $FullName, $UserStatus, $Contact) {
		$this->setUID($UID);
		$this->setEmail($Email);
		$this->setPassword($Password);
		$this->setUserType($UserType);
		$this->setCompanyName($CompanyName);
		$this->setCompAddress1($CompAddress1);
		$this->setCompAddress2($CompAddress2);
		$this->setPostcode($Postcode);
		$this->setState($State);
		$this->setRegion($Region);
		$this->setFullName($FullName);
		$this->setUserStatus($UserStatus);
		$this->setContact($Contact);
	}

	// UID
	public function setUID($newval) {
		$this->UID = $newval;
	}

	public function getUID() {
		return $this->UID;
	}

	// email
	public function setEmail($newval) {
		$this->Email = $newval;
	}

	public function getEmail() {
		return $this->Email;
	}
	
	// password
	public function setPassword($newval) {
		$this->Password = $newval;
	}

	public function getPassword() {
		return $this->Password;
	}
	
	// usertype
	public function setUserType($newval) {
		$this->UserType = $newval;
	}

	public function getUserType() {
		return $this->UserType;
	}
	
	// company name
	public function setCompanyName($newval){
		$this->CompanyName = $newval;
	}

	public function getCompanyName() {
		return $this->CompanyName;
	}

	// compaddr2
	public function setCompAddress1($newval) {
		$this->CompAddress1 = $newval;
	}

	public function getCompAddress1() {
		return $this->CompAddress1;
	}
	
	// compaddr2
	public function setCompAddress2($newval) {
		$this->CompAddress2 = $newval;
	}

	public function getCompAddress2() {
		return $this->CompAddress2;
	}

	// Postcode
	public function setPostcode($newval) {
		$this->Postcode = $newval;
	}

	public function getPostcode() {
		return $this->Postcode;
	}

	// state
	public function setState($newval) {
		$this->State = $newval;
	}

	public function getState() {
		return $this->State;
	}

	// region
	public function setRegion($newval) {
		$this->Region = $newval;
	}

	public function getRegion() {
		return $this->Region;
	}

	// full name
	public function setFullName($newval) {
		$this->FullName = $newval;
	}

	public function getFullName(){
		return $this->FullName;
	}

	// contact
	public function setContact($newval){
		$this->Contact = $newval;
	}

	public function getContact(){
		return $this->Contact;
	}

	// userstatus
	public function setUserStatus($newval) {
		$this->UserStatus = $newval;
	}

	public function getUserStatus() {
		return $this->UserStatus;
	}
}

?>