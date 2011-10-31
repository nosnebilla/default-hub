<?php

require_once ((realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR)) . DIRECTORY_SEPARATOR . 'test_helpers.php');
require_once APP_DIR . '/models/symbolicator.php';
 
class ErrorReportParserTest extends PHPUnit_Framework_TestCase {
    
  public function testExceptionReportV2() {
    $exception_report = file_get_contents('fixtures/exception_report_v2.txt');
    $symbolicator = new Symbolicator($exception_report, 'tower1', '1.1.1');
    $result = $symbolicator->symbolicate();
    var_dump($result);
  }
  
  public function testExceptionReportV1() {
    $exception_report = file_get_contents('fixtures/exception_report_v1.txt');
    $symbolicator = new Symbolicator($exception_report, 'tower1', '1.0.8');
    $result = $symbolicator->symbolicate();
    var_dump($result);
  }
}
