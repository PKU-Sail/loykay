<?php
class CompanyModel extends BaseModel
{
	public function __construct($db = false)
	{
		parent::__construct($db);
	}
	
	public $_keys = array('UID','NAME','QUALIFY','LEVEL');
	public $_keyMap = array('NAME' => 'company_name');
	public $_alias = array('NAME' => 'NEW_NAME');
	public $_table = 'institution';
}