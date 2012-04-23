<?php

#error_reporting(E_ALL);
#ini_set('display_errors', '1');

require_once(__DIR__ . '/stdinc.php');
#append_include_path(__DIR__);

#$objUser = new User('Muslim', 'Idris', 24);
$objUser = Singleton::getInstance('User', array('Muslim', 'Idris', 24));

#$objConfig = new Config('main');
$objConfig = Singleton::getInstance('Config', array('main'));

#$tpl = new Template('index');
$tpl = Singleton::getInstance('Template', array('index'));
$tpl->assign('name', 'Muslim');
$tpl->exec();
