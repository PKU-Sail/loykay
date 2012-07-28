<?php
class HybridModel extends BaseModel
{
	private $ma = array();
	
	public function __construct($ma,$db)
	{
		parent::__construct($db);
		if(!is_array($ma))
		{
			return false;
		}
		$this->ma = $ma;
	}
	
	public function select($multy = false)
	{
		$tables = '';
		$tb = array();
		$keyStr = array();
		foreach ($this->ma as $mo)
		{
			$keys = '';
			$alia = substr(get_class($mo), 0,-5);
			$kb = array();
			foreach ($mo->_keys as $key)
			{
				$newKey = $alia . '.' . $key;
				if(array_key_exists($key, $mo->_alias))
					$newKey .= ' as ' . $mo->_alias[$key];
				array_push($kb,$newKey);
			}
			$keys .= implode(',', $kb);
			array_push($keyStr,$keys);
			array_push($tb,$mo->_table . ' ' . $alia);
		}
		$keys = implode(',', $keyStr);
		$tables = implode(',', $tb);
		$sql = 'select ' . $keys . ' from ' . $tables . ' ' . (isset($this->options['order']) ? $this->options['order'] : '') . ' ' . (isset($this->options['where']) ? $this->options['where'] : '') . ' ' . (isset($this->options['limit']) ? $this->options['limit'] : '');
		$result = $this->db->query($sql);
		if($result === false)
			return false;
		if($multy === false)
			$data = $this->db->getSingleResult();
		else
			$data = $this->db->getMultyResult();
		return $data;
	}
}


