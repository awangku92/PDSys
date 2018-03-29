<?php
 
public class LogTickets
{
	public $TicketID;
	public function setTicketID($newval)
	  {
	      $this->TicketID = $newval;
	  }

	public function getTicketID()
	  {
	      return $this->TicketID;
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

	public $DateTime;
	public function setDateTime($newval)
	  {
	      $this->DateTime = $newval;
	  }

	public function getDateTime()
	  {
	      return $this->DateTime;
	  }

	public $PostponeDateTime;
	public function setPostponeDateTime($newval)
	  {
	      $this->PostponeDateTime = $newval;
	  }

	public function getPostponeDateTime()
	  {
	      return $this->PostponeDateTime;
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

	public $Reason;
	public function setReason($newval)
	  {
	      $this->Reason = $newval;
	  }

	public function getReason()
	  {
	      return $this->Reason;
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