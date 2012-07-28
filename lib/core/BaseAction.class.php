<?php
abstract class BaseAction
{
	abstract function preCall();
	abstract function lasCall();
	protected $tpl;
	
	public function __construct()
	{
		$this->tpl = new libTpl();
	}
}