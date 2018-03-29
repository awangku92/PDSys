<?php
 
public class Branches
{
	public $BranchesID;
	public function setBranchesID($newval)
	  {
	      $this->BranchesID = $newval;
	  }

	public function getBranchesID()
	  {
	      return $this->BranchesID;
	  }

	public $UID;
	public function setUID($newval)
	  {
	      $this->UID = $newval;
	  }

	public function getUID()
	  {
	      return $this->UID;
	  }

	public $Address1;
	public function setAddress1($newval)
	  {
	      $this->Address1 = $newval;
	  }

	public function getAddress1()
	  {
	      return $this->Address1;
	  }

	public $Address2;
	public function setAddress2($newval)
	  {
	      $this->Address2 = $newval;
	  }

	public function getAddress2()
	  {
	      return $this->Address2;
	  }

	public $Postcode;
	public function setPostcode($newval)
	  {
	      $this->Postcode = $newval;
	  }

	public function getPostcode()
	  {
	      return $this->Postcode;
	  }

	public $State;
	public function setState($newval)
	  {
	      $this->State = $newval;
	  }

	public function getState()
	  {
	      return $this->State;
	  }

	public $Region;
	public function setRegion($newval)
	  {
	      $this->Region = $newval;
	  }

	public function getRegion()
	  {
	      return $this->Region;
	  }

}
 
?>