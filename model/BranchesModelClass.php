<?php
 
public class Branches
{
	var $BranchesID, $UID, $Address1, $Address2, $Postcode, $State, $Region;

	public function __construct($BranchesID, $UID, $Address1, $Address2, $Postcode, $State, $Region) {
		$this->setBranchesID($BranchesID);
		$this->setUID($UID);
		$this->setAddress1($Address1);
		$this->setAddress2($Address2);
		$this->setPostcode($Postcode);
		$this->setState($State);
		$this->setRegion($Region);
	}
	
	public function setBranchesID($newval)
	  {
	      $this->BranchesID = $newval;
	  }

	public function getBranchesID()
	  {
	      return $this->BranchesID;
	  }

	public function setUID($newval)
	  {
	      $this->UID = $newval;
	  }

	public function getUID()
	  {
	      return $this->UID;
	  }

	public function setAddress1($newval)
	  {
	      $this->Address1 = $newval;
	  }

	public function getAddress1()
	  {
	      return $this->Address1;
	  }

	public function setAddress2($newval)
	  {
	      $this->Address2 = $newval;
	  }

	public function getAddress2()
	  {
	      return $this->Address2;
	  }
	
	public function setPostcode($newval)
	  {
	      $this->Postcode = $newval;
	  }

	public function getPostcode()
	  {
	      return $this->Postcode;
	  }
	
	public function setState($newval)
	  {
	      $this->State = $newval;
	  }

	public function getState()
	  {
	      return $this->State;
	  }

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
