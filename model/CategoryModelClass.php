<?php
 
class Category
{
	var $CategoryID, $CategoryType, $Priority;
	
	public function __construct($CategoryID, $CategoryType, $Priority) {
		$this->setCategoryID($CategoryID);
		$this->setCategoryType($CategoryType);
		$this->setPriority($Priority);
	}
	
	public function setCategoryID($newval)
	  {
	      $this->CategoryID = $newval;
	  }

	public function getCategoryID()
	  {
	      return $this->CategoryID;
	  }

	public function setCategoryType($newval)
	  {
	      $this->CategoryType = $newval;
	  }

	public function getCategoryType()
	  {
	      return $this->CategoryType;
	  }
	
	public function setPriority($newval)
	  {
	      $this->Priority = $newval;
	  }

	public function getPriority()
	  {
	      return $this->Priority;
	  }
}
 
?>
