<?php
 
public class Status
{
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