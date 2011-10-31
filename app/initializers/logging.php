<?php

require_once LIB_DIR . DS . 'logger/logger.php';

$app = Application::instance();

if (!file_exists(LOG_DIR)) {
  $msg = sprintf("Log directory `%s` does not exist. Please create the log directory.", LOG_DIR);
  throw new Exception($msg);
} else if (!is_writable(LOG_DIR)) {
  $msg = sprintf("Log directory `%s` is not writable for user `%s`. Please change the file permissions on the log directory.", LOG_DIR, exec('whoami'));
  throw new Exception($msg);  
}

// PHP error log file
$php_error_log = LOG_DIR . DS . $app->env() . '_php_errors.log';

if(!file_exists($php_error_log)) {
  touch($php_error_log);
  chmod($php_error_log, 0666);
}

ini_set('error_log', $php_error_log);
ini_set('log_errors', 1);

// Application error log file
$log_file = LOG_DIR . DS . $app->env() . '.log';

if(!file_exists($log_file)) {
  touch($log_file);
  chmod($log_file, 0666);
}

$logger = new Logger($log_file);

if (is_production()) {
  $logger->setLogLevel(Logger::LOG_LEVEL_INFO);
}

$app->setLogger($logger);
