<?php
define('ROOT_PATH', dirname(dirname(__FILE__)) . '/');
define('LIB_PATH' , ROOT_PATH . 'lib/');
define('TPL_PATH' , ROOT_PATH . 'tpl/');
define('SOURCE_PATH' , ROOT_PATH . 'source/');
define('CUSTOM_PATH' , ROOT_PATH . 'custom/');
define('CONF_PATH' , ROOT_PATH . 'conf/');
define('CORE_PATH',LIB_PATH . 'core/');
define('ACTION_PATH',LIB_PATH . 'action/');
define('MODEL_PATH',LIB_PATH . 'model/');

//set 1 to run in debug mode.
define(DEBUG_MODE, 1); 

require_once 'common.php';
require_once CORE_PATH . 'Loykay.class.php';

Loykay::init();
Loykay::run();
