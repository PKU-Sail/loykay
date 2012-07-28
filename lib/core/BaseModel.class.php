<?php
abstract class BaseModel
{
	protected $table;
	protected $fields;
	protected $db;
	protected $options = array();
	
	/*
	 * key is the real key name of table.
	 * value is the key name of data from client. like $_POST , $_GET
	 */
	protected $_keyMap = array();
	
	/*
	 * keys name of table.
	 */
	protected $_keys = array();
	
	/*
	 * key is the real key name of table.
	 * value is custom key name of data you got from database.
	 * 
	 * you can define your own name of keys of data you got from database through this array.
	 */
	protected $_alias = array();
	
	
	protected function __construct($db = false)
	{
		$this->db = $db;
	}
	
	public function query($sql)
	{
		return $this->db->query($sql);
	}
	
	/*
	 * create data array depend on a model.
	 * @param $data , data to be added to the object.
	 */
	public function create($data = false)
	{
		if($data === false)
			$data = $_POST;
		$lv = array();
		if(is_array($this->_keys) && !empty($this->_keys))
		{
			foreach ($this->_keys as $v)
			{
				if(array_key_exists($v, $data))
				{
					$lv[$v] = $data[$v];
				}
				elseif(array_key_exists($v, $this->_keyMap) && array_key_exists($v, $data))
				{
					$lv[$v] = $data[$this->_keyMap[$v]]; 
				}
			}
			return $lv;
		}
		else
		{
			return false;
		}
	}
	
	public function insert($obj)
	{
		if(is_array($obj) && $obj != null)
		{
			$sql = 'insert into ' . (isset($this->_table) ? $this->_table : $this->options['table']) . ' ' . implode_key($obj) . ' values ' . implode_value($obj);
			if(!$this->db->query($sql))
				return false;
			else
				return true;
		}
		else
		{
			return false;
		}
	}
	
	public function update($data)
	{
		if(!is_array($data))
			return false;
		$str = ' ';
		$buff = array();
		foreach($data as $key => $value)
		{
			array_push($buff, '`'.$key.'`=\''.$value.'\'');
		}
		$str .= implode(',',$buff);
		$sql = 'update ' . (isset($this->_table) ? $this->_table : $this->options['table']) . ' set ' . $str . $this->options['where'];
		if(!$this->db->query($sql) || $this->db->getAffectedRows() == 0)
			return false;
		else
			return true;
	}
	
	public function select($fields = false,$multy = false)
	{
		if(!is_array($fields) && $fields !== false)
		{
			return false;
		}
		if(!empty($this->_alias))
		{
			foreach($this->_alias as $key => $alias)
			{
				foreach ($this->_keys as $k => $v)
				{
					if($v != $key)
						continue;
					else
						$this->_keys[$k] .= ' as ' . $alias;	
				}
			}
		}
		$sql = 'select ' . ($fields ? implode_key($fields) : implode(',',$this->_keys)) . ' from ' . (isset($this->_table) ? $this->_table : $this->options['table']) . ' ' . (isset($this->options['order']) ? $this->options['order'] : '') . ' ' . (isset($this->options['where']) ? $this->options['where'] : '') . ' ' . (isset($this->options['limit']) ? $this->options['limit'] : '');
		$result = $this->db->query($sql);
		if($result === false)
			return false;
		if($multy === false)
			$data = $this->db->getSingleResult();
		else
			$data = $this->db->getMultyResult();
		return $data;
	}
	
	public function multySelect($a)
	{
		if(!is_array($a))
			return false;
		$tables = array();
		$keys = array();
		foreach ($a as $v)
		{
			$ali = substr(get_class($a), 0,-5);
			array_push($tables, $v->_table . ' ' . $ali);
			foreach ($v->_keys as $keys)
			{
				array_push($keys, $ali . '\.' . $keys);
			}
		}
		$sql = 'select (' . implode(',',$keys) . ') from ' . implode(',', $tables) . ' ' . (isset($this->options['order']) ? $this->options['order'] : '') . ' ' . (isset($this->options['where']) ? $this->options['where'] : '') . ' ' . (isset($this->options['limit']) ? $this->options['limit'] : '');
		$result = $this->db->query($sql);
		if($result === false)
			return false;
		if($multy === false)
		{
			$data = $this->db->getSingleResult();
		}
		else
		{
			$data = $this->db->getMultyResult();
		}
		return $data;
	}
	
	public function delete()
	{
		$sql = 'delete from' . $this->options['table'] . $this->options['where'];
		if(!$this->db->query($sql) || $this->db->getAffectedRows() == 0)
			return false;
		else
			return true;
	}
	
	public function table($sql)
	{
		$this->options['table'] = ' ' . $sql . ' ';
		return $this;
	}
	
	public function where($sql)
	{
		$this->options['where'] = ' where ' . $sql . ' ';
		return $this;
	}
	
	public function order($sql)
	{
		$this->options['order'] = ' ' . $sql . ' ';
		return $this;
	}
	
	public function limit()
	{
		$this->options['order'] = ' ' . $sql . ' ';
		return $this;
	}
	
	protected function getFields()
	{
		if(isset($_fields) && is_array($_fields))
		{
			
		}
		else
		{
			$sql = 'desc' . $this->options['table'];
			if(!$this->db->query($sql))
				return false;
			$r = $this->db->getMultyResult();
			$keys = array();
			foreach ($r as $v)
			{
				array_push($keys, $v['Field']);
			}
			return $keys;
		}
	}
}