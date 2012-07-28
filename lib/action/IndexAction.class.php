<?php
class IndexAction extends BaseAction
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function preCall()
	{
		
	}
	
	public function lasCall()
	{
	}
	
	public function sayHello()
	{
		$this->tpl->draw('lala');
	}
}