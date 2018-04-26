<?php
 
class Status
{
	var $StatusID, $StatusDetail;
	
	public function __construct($StatusID, $StatusDetail) {
		$this->setStatusID($StatusID);
		$this->setStatusDetail($StatusDetail);
	}
	
	public function setStatusID($newval)
	  {
	      $this->StatusID = $newval;
	  }

	public function getStatusID()
	  {
	      return $this->StatusID;
	  }

	public function setStatusDetail($newval)
	  {
	      $this->StatusDetail = $newval;
	  }

	public function getStatusDetail()
	  {
	      return $this->StatusDetail;
	  }
}
 
?>
