<?php

require_once APP_HELPERS_DIR . '/error_cases_helpers.php';
require_once APP_MODELS_DIR . '/crash_report.php';

class ErrorCase {
  
  private $appIdentifier;
  private $errorIdentifier;
  private $reason;
  private $count;
  private $latest;
  private $versions;
  private $crashReports;
  
  public static function findAll() {
    $url = error_cases_api_url();

    $ch = curl_init();		
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		
		$response = curl_exec($ch);
		curl_close($ch);
		
		$items = array();
		
		$xml = simplexml_load_string($response);
		
		foreach ($xml->errorCase as $error_case) {
      $items[] = self::createFromXML($error_case);  
    }
    
		return $items;
  }
  
  public static function findByID($id) {
    $url = error_cases_api_url($id);

    $ch = curl_init();		
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		
		$response = curl_exec($ch);
		curl_close($ch);

		$xml = simplexml_load_string($response);
		
		$item = self::createFromXML($xml);      
		return $item;
  }
  
  public static function createFromXML(SimpleXMLElement $xml) {
    $values = array();
    
    foreach ($xml->children() as $element) {
      $values[$element->getName()] = (String)$element;
    }
    
    $item = new self($values);
    return $item;
  }
  
  public function __construct(Array $values = array()) {
    foreach ($values as $key => $value) {
      $this->$key = $value;
    }    
  }
  
  public function getID() {
    return $this->id;
  }
  
  public function getAppIdentifier() {
    return $this->appIdentifier;
  }
  
  public function getErrorIdentifier() {
    return $this->errorIdentifier;
  }
  
  public function getReason() {
    return $this->reason;
  }
  
  public function getLatest() {
    return $this->latest;
  }
  
  public function getVersions() {
    return $this->versions;
  }
  
  public function getCount() {
    return $this->count;
  }
  
  public function getCrashReports() {
    if ($this->crashReports === null) {
      $this->crashReports = CrashReport::findAllByErrorCase($this->id);
    }
    
    return $this->crashReports;
  }
  
  public function __get($name) {
    switch ($name) {
      case 'id';
        return $this->getID();
      case 'appIdentifier';
        return $this->getAppIdentifier();
      case 'errorIdentifier';
        return $this->getErrorIdentifier();
      case 'reason';
        return $this->getReason();
      case 'latest';
        return $this->getLatest();
      case 'versions';
        return $this->getVersions();
      case 'count';
        return $this->getCount();
      case 'crashReports';
        return $this->getCrashReports();
    }
    
    return null;    
  }
}