<?php

class Logger {
  
  const LOG_LEVEL_ERROR = 1;
  const LOG_LEVEL_WARNING = 2;
  const LOG_LEVEL_INFO = 3;
  const LOG_LEVEL_DEBUG = 4;
  
  private $logFile;
  private $logLevel;
  
  public function __construct($log_file, $log_level = self::LOG_LEVEL_DEBUG) {
    $this->logFile = $log_file;
    $this->logLevel = $log_level;
  }
  
  public function getLogFile() {
    return $this->logFile;
  }
  
  public function getLogLevel() {
    return $this->logLevel;
  }
  
  public function setLogLevel($log_level) {
    $this->logLevel = $log_level;
  }
  
  public function debug($msg) {
    $this->write($msg, self::LOG_LEVEL_DEBUG);
  }
  
  public function info($msg) {
    $this->write($msg, self::LOG_LEVEL_INFO);
  }
  
  public function warn($msg) {
    $this->write($msg, self::LOG_LEVEL_WARNING);
  }
  
  public function error($msg) {
    $this->write($msg, self::LOG_LEVEL_ERROR);
  }
  
  private function write($msg, $log_level) {
    if ($log_level > $this->logLevel) {
      return;
    }
    
    $full_msg = sprintf("%s %s\n", date('c'), $msg);
    
    $fp = fopen($this->logFile, "a+");

    if (flock($fp, LOCK_EX)) {
        fwrite($fp, $full_msg);
        flock($fp, LOCK_UN);
    }

    fclose($fp);
  }
}