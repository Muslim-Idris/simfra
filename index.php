<?php

require_once(__DIR__ . '/stdinc.php');
#append_include_path(__DIR__);

#$objConfig = new Config('main');
$objConfig = Singleton::getInstance('Config', array('main'));

#$tpl = new Template('index');
$tpl = Singleton::getInstance('Template', array('index'));
$tpl->assign('name', 'Muslim');
$tpl->exec();

