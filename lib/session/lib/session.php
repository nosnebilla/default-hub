<?php

class SessionException extends Exception {}

class Session implements ArrayAccess, Iterator {
  
  private $name;
  
  public static function start($name) {
    return new self($name);
  }
  
  public function __construct($name) {
    $this->name = $name;
    
    if (!session_start()) {
      $msg = sprintf("Session could not be started. There may be another session active.");
      new SessionException($msg);
    }
    
    if (!array_key_exists($name, $_SESSION)) {
      $_SESSION[$name] = array();
    }
  }
  
  public function get($key) {
    return $this->getVariable($key);
  }
  
  public function getVariable($key) {
    if (array_key_exists($key, $_SESSION[$this->name])) {
      return $_SESSION[$this->name][$key];
    }
    
    return null;
  }
  
  public function set($key, $value) {
    return $this->setVariable($key, $value);
  }
  
  public function setVariable($key, $value) {
    $_SESSION[$this->name][$key] = $value;
  }
  
  public function delete($key) {
    return $this->deleteVariable($key);
  }
  
  public function deleteVariable($key) {
    if (array_key_exists($key, $_SESSION[$this->name])) {
      unset($_SESSION[$this->name][$key]);
    }
  }
  
  public function save() {
    session_write_close();
  }
  
  public function close() {
    session_write_close();
  }
  
  public function destroy() {
    unset($_SESSION[$this->name]);
    session_write_close();
  }
  
  public function __get($name) {
    return $this->getVariable($name);
  }
  
  public function __set($name, $value) {
    $this->setVariable($name, $value);
  }
  
  public function offsetExists($key) {
    return array_key_exists($key, $_SESSION[$this->name]);
  }

  public function offsetGet($key) {
    return $this->getVariable($key);
  }

  public function offsetSet($key, $value) {
    $this->setVariable($key, $value);
  }

  public function offsetUnset($key) {
    $this->deleteVariable($key);
  }
  
  public function rewind() {
    reset($_SESSION[$this->name]);
  }

  public function valid() {
    return current($_SESSION[$this->name]);
  }

  public function key() {
    return key($_SESSION[$this->name]);
  }

  public function current() {
    return current($_SESSION[$this->name]);
  }

  public function next() {
    return next($_SESSION[$this->name]);
  }
}