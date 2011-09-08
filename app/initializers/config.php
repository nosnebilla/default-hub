<?php

require_once LIB_DIR . DS . 'config/config.php';

Config::setBaseConfigPath(CONFIG_DIR);

$app = Application::instance();
$app->setName(Config::get('app.ini', 'general.name'));
$app->setTimeZone(Config::get('app.ini', 'general.time_zone'));
$app->setLocale(Config::get('app.ini', 'general.locale'));
