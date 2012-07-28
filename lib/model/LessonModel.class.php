<?php
class LessonModel extends BaseModel
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public $_keys = array('TNAME','TYPE');
	public $_table = 'lesson';
}