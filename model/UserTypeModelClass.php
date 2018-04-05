<?php
 
public class UserType
{
	var $UserType;
	
	public function __construct($UserType) {
		$this->setBranchesID($UserType);
	}
	
	public function setUserType($newval)
	  {
	      $this->UserType = $newval;
	  }

	public function getUserType()
	  {
	      return $this->UserType;
	  }
}
 
?>
