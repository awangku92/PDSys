<?php
 
public class UserType
{
	public $UserType;
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