<?php
 
class Ticket
{
	var $UID, $TicketID, $SearchID, $DateTime, $BranchID, $CategoryID, $StatusID, $Detail, $UIDContractor;
	
	public function __construct($UID, $TicketID, $SearchID, $DateTime, $BranchID, $CategoryID, $StatusID, $Detail, $UIDContractor) {
		$this->setUID($UID);
		$this->setTicketID($TicketID);
		$this->setSearchID($SearchID);
		$this->setDateTime($DateTime);
		$this->setBranchID($BranchID);
		$this->setCategoryID($CategoryID);
		$this->setStatusID($StatusID);
		$this->setDetail($Detail);
		$this->setUIDContractor($UIDContractor);
	}
	
	public function setUID($newval)
	  {
	      $this->UID = $newval;
	  }

	public function getUID()
	  {
	      return $this->UID;
	  }

	public function setTicketID($newval)
	  {
	      $this->TicketID = $newval;
	  }

	public function getTicketID()
	  {
	      return $this->TicketID;
	  }

	public function setSearchID($newval)
	  {
	      $this->SearchID = $newval;
	  }

	public function getSearchID()
	  {
	      return $this->SearchID;
	  }

	public function setDateTime($newval)
	  {
	      $this->DateTime = $newval;
	  }

	public function getDateTime()
	  {
	      return $this->DateTime;
	  }

	public function setBranchID($newval)
	  {
	      $this->BranchID = $newval;
	  }

	public function getBranchID()
	  {
	      return $this->BranchID;
	  }

	public function setCategoryID($newval)
	  {
	      $this->CategoryID = $newval;
	  }

	public function getCategoryID()
	  {
	      return $this->CategoryID;
	  }

	public function setStatusID($newval)
	  {
	      $this->StatusID = $newval;
	  }

	public function getStatusID()
	  {
	      return $this->StatusID;
	  }

	public function setDetail($newval)
	  {
	      $this->Detail = $newval;
	  }

	public function getDetail()
	  {
	      return $this->Detail;
	  }

	public function setUIDContractor($newval)
	  {
	      $this->UIDContractor = $newval;
	  }

	public function getUIDContractor()
	  {
	      return $this->UIDContractor;
	  }
}
 
?>
