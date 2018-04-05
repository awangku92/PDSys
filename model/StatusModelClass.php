<?php
 
public class Status
{
	var $StatusID, $StatusSetail;
	
	public function __construct($StatusID, $StatusSetail) {
		$this->setStatusID($StatusID);
		$this->setStatusSetail($StatusSetail);
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

	public $StatusSetail;
	public function setStatusSetail($newval)
	  {
	      $this->StatusSetail = $newval;
	  }

	public function getStatusSetail()
	  {
	      return $this->StatusSetail;
	  }
}
 
?>
