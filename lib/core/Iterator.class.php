<?php 
abstract class LIterator implements Iterator
{	
	protected $pages = array();
	protected $currentPage = 1;
	protected $db;
	protected $numPerPage;
	protected $all;
	
	/*
	 * get data of a page.
	 * success , return data array or null.
	 * failed  , return false.
	 */
	abstract function getSinglePage();
	
	/*
	 * @return , count all. 
	 */
	abstract function getAllCount();
	
	public function __construct($db)
	{
		$this->db = $db;
		$this->count = $this->getAllCount();
	}
	
	public function current() 
	{
		return current($this->pages[$this->currentPage]);
	}

	public function next() 
	{
		next($this->pages[$this->currentPage]);
		if(key($this->pages[$this->currentPage]) == null && count($this->pages[$this->currentPage]) == $this->numPerPage)
		{
			$this->currentPage++;
			if(is_array(@$this->pages[$this->currentPage]))
				reset($this->pages[$this->currentPage]);
		}
	}

	public function key() 
	{
		return $this->numPerPage * ($this->currentPage - 1) + key($this->pages[$this->currentPage]);
	}

	public function valid() 
	{
		if(!array_key_exists($this->currentPage, $this->pages))
		{
			$page = $this->getSinglePage();
			if($page == null || $page == false)
				return false;
			else
			{
				$this->pages[$this->currentPage] = $page;
				reset($this->pages[$this->currentPage]);
				return true;
			}
		}
		else
		{
			if(key($this->pages[$this->currentPage]) == null)
				return false;
			else
				return true;
		}
	}
	
	public function rewind () 
	{
		$this->currentPage = 1;
		if(array_key_exists(1, $this->pages))
			reset($this->pages[1]);
	}
	
	public function seek($index)
	{
		 if($index < 0 || $index > $this->all)
	          throw new OutOfBoundsException();
	     $this->currentPage = (int)floor($index/$this->dataPerPage) + 1;
	     $page = $this->getPage();
	     reset($page);
	     for($i = $index % $this->dataPerPage;$i > 0;$i--)
	     {
	          next($page);
	     }
	}
}
?>