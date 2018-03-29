<?php
 
public class Category
{
	public $CategoryID;
	public function setCategoryID($newval)
	  {
	      $this->CategoryID = $newval;
	  }

	public function getCategoryID()
	  {
	      return $this->CategoryID;
	  }

	public $CategoryType;
	public function setCategoryType($newval)
	  {
	      $this->CategoryType = $newval;
	  }

	public function getCategoryType()
	  {
	      return $this->CategoryType;
	  }

	public $Priority;
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