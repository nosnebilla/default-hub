<?php

require_once ((realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR))
  . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'init.php');

$request = new Request();
Application::dispatch($request);
exit;
