<?php
 
public class LogTickets
{
	var $TicketID, $UID, $DateTime, $PostponeDateTime, $StatusID, $Reason, $UIDContractor;
	
	public function __construct($TicketID, $UID, $DateTime, $PostponeDateTime, $StatusID, $Reason, $UIDContractor) {
		$this->setTicketID($TicketID);
		$this->setUID($UID);
		$this->setDateTime($DateTime);
		$this->setPostponeDateTime($PostponeDateTime);
		$this->setStatusID($StatusID);
		$this->setReason($Reason);
		$this->setUIDContractor($UIDContractor);
	}
	
	public function setTicketID($newval)
	  {
	      $this->TicketID = $newval;
	  }

	public function getTicketID()
	  {
	      return $this->TicketID;
	  }

	public function setUID($newval)
	  {
	      $this->UID = $newval;
	  }

	public function getUID()
	  {
	      return $this->UID;
	  }

	public function setDateTime($newval)
	  {
	      $this->DateTime = $newval;
	  }

	public function getDateTime()
	  {
	      return $this->DateTime;
	  }

	public function setPostponeDateTime($newval)
	  {
	      $this->PostponeDateTime = $newval;
	  }

	public function getPostponeDateTime()
	  {
	      return $this->PostponeDateTime;
	  }
	
	public function setStatusID($newval)
	  {
	      $this->StatusID = $newval;
	  }

	public function getStatusID()
	  {
	      return $this->StatusID;
	  }

	public function setReason($newval)
	  {
	      $this->Reason = $newval;
	  }

	public function getReason()
	  {
	      return $this->Reason;
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
