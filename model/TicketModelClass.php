<?php
 
public class Ticket
{
	public $UID;
	public function setUID($newval)
	  {
	      $this->UID = $newval;
	  }

	public function getUID()
	  {
	      return $this->UID;
	  }

	public $TicketID;
	public function setTicketID($newval)
	  {
	      $this->TicketID = $newval;
	  }

	public function getTicketID()
	  {
	      return $this->TicketID;
	  }

	public $SearchID;
	public function setSearchID($newval)
	  {
	      $this->SearchID = $newval;
	  }

	public function getSearchID()
	  {
	      return $this->SearchID;
	  }

	public $DateTime;
	public function setDateTime($newval)
	  {
	      $this->DateTime = $newval;
	  }

	public function getDateTime()
	  {
	      return $this->DateTime;
	  }

	public $BranchID;
	public function setBranchID($newval)
	  {
	      $this->BranchID = $newval;
	  }

	public function getBranchID()
	  {
	      return $this->BranchID;
	  }

	public $CategoryID;
	public function setCategoryID($newval)
	  {
	      $this->CategoryID = $newval;
	  }

	public function getCategoryID()
	  {
	      return $this->CategoryID;
	  }

	public $StatusID;
	public function setStatusID($newval)
	  {
	      $this->StatusID = $newval;
	  }

	public function getStatusID()
	  {
	      return $this->StatusID;
	  }

	public $Detail;
	public function setDetail($newval)
	  {
	      $this->Detail = $newval;
	  }

	public function getDetail()
	  {
	      return $this->Detail;
	  }

	public $UIDContractor;
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