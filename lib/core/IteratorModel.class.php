<?php 
class IteratorModel extends IteratorIterator
{
	private $currentIndex;
	private $page;
	private $numPerPage;
	
	public function rewind()
	{
		$this->currentIndex = 0;
		$this->getInnerIterator()->seek($this->numPerPage*($this->page - 1));
	}
	
	public function key()
	{
		return $this->getInnerIterator()->key();
	}
	
	public function current()
	{
		return $this->getInnerIterator()->current();
	}
	
	public function valid()
	{
		return ($this->getInnerIterator()->valid() && $this->currentIndex != $this->numPerPage);
	}
	
	public function next()
	{
		$this->currentIndex++;
		$this->getInnerIterator()->next();
	}
	
	public function __construct($iterator,$page,$numPerPage)
	{
		parent::__construct($iterator);
		$this->page = $page;
		$this->numPerPage = $numPerPage;
	}
}



?>