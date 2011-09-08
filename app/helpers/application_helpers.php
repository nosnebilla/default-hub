<?php

function is_cli() {
  return array_key_exists('argc', $_SERVER);
}

function exception_error_handler($code, $message, $file, $line) {
  throw new ErrorException($message, 0, $code, $file, $line);
}

function exception_handler(Exception $exception) {
  Application::handleException($exception);
}

function env() {
  return Application::instance()->env();
}

function is_development() {
	return Application::instance()->isEnvironment('development');
}

function is_test() {
  return Application::instance()->isEnvironment('testing');
}

function is_production() {
  return Application::instance()->isEnvironment('production');
}

function is_get_request() {
  return (Application::instance()->request()->method() == 'GET');
}

function is_post_request() {
  return (Application::instance()->request()->method() == 'POST');
}

function is_put_request() {
  return (Application::instance()->request()->method() == 'PUT');
}

function is_delete_request() {
  return (Application::instance()->request()->method() == 'DELETE');
}

function redirect_to($url) {
  if (str_begins_with($url, 'http')) {
    http_redirect_to($url);
  } else {
    http_redirect_to($url, Application::instance()->request()->hostname(), Application::instance()->request()->isSSL());
  }
}

function etag($buffer) {
	return sha1($buffer);
}

function save_tmp_file($contents) {
  $tmpfile = TMP_DIR . DS . uniqid();
  file_put_contents($tmpfile, $contents, FILE_APPEND);
}

function log_debug($msg) {
  $logger = Application::instance()->logger();
  $logger->debug($msg);
}

function log_info($msg) {
  $logger = Application::instance()->logger();
  $logger->info($msg);
}

function log_warn($msg) {
  $logger = Application::instance()->logger();
  $logger->warn($msg);
}

function log_error($msg) {
  $logger = Application::instance()->logger();
  $logger->error($msg);
}

function symbolicate($app_name, $app_version, $trace, $arch = 'i386') {
  $symbolicater = new Symbolicator($report);
  $symbolicater->symbolicate();
  
  $trace = str_replace("\n", ' ', $trace);
  $full_path = sprintf("%s/tower1/%s/Tower.app/Contents/MacOS/Tower", RELEASES_DIR, $app_version);
  $cmd = sprintf("/usr/bin/atos -arch %s -o %s %s", $arch, $full_path, $trace);
  $output = system($cmd);
  return $output;
}

# EOF