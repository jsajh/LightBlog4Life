<?php
define('APPLICATION_PATH', dirname(__FILE__));

define('ROOT_PATH', __DIR__);
define('CONF_PATH', ROOT_PATH . '/conf/');
define('SERVER_TYPE', get_cfg_var('env'));

$app = new Yaf_Application(APPLICATION_PATH . '/conf/application_' . SERVER_TYPE . '.ini');
$app->bootstrap()->run();