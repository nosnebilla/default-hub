<?php

require_once APP_HELPERS_DIR . '/crash_reports_helpers.php';

class CrashReport {
  
  private $id;
  private $type;
  private $appName;
  private $appVersion;
  private $exceptionType;
  private $exceptionReason;
  private $sysinfoOsVersion;
  private $sysinfoKernelVersion;
  private $sysinfoModelName;
  private $sysinfoModelIdentifier;
  private $sysinfoProcessorName;
  private $sysinfoProcessorSpeed;
  private $sysinfoNumProcessors;
  private $sysinfoNumCores;
  private $sysinfoPhysicalMemory;
  private $summary;
  private $trace;
  private $symbolicatedTrace;
  private $userComment;
  private $uid;
  private $isRead;
  private $createdAt;
  private $updatedAt;
  
  public static function findAll() {
    $url = crash_reports_api_url();

    $ch = curl_init();		
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		
		$response = curl_exec($ch);
		curl_close($ch);
		
		$items = array();
		
		$xml = simplexml_load_string($response);
		
		foreach ($xml->crashReport as $crash_report) {
      $items[] = self::createFromXML($crash_report);  
    }
    
		return $items;
  }
  
  public static function findAllByErrorCase($error_case_id) {
    $url = error_case_crash_reports_api_url($error_case_id);

    $ch = curl_init();		
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		
		$response = curl_exec($ch);
		curl_close($ch);
		
		$items = array();
		
		$xml = simplexml_load_string($response);
		
		foreach ($xml->crashReport as $crash_report) {
      $items[] = self::createFromXML($crash_report);  
    }
    
		return $items;
  }
  
  public static function findByID($id) {
    $url = crash_reports_api_url($id);

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
  
  public function __get($name) {
    switch ($name) {
      case 'id';
        return $this->id;
      case 'type';
        return $this->type;
      case 'appName';
        return $this->appName;
      case 'appVersion';
        return $this->appVersion;
      case 'exceptionType';
        return $this->exceptionType;
      case 'exceptionReason';
        return $this->exceptionReason;
      case 'sysinfoOsVersion';
        return $this->sysinfoOsVersion;
      case 'sysinfoKernelVersion';
        return $this->sysinfoKernelVersion;
      case 'sysinfoModelName';
        return $this->sysinfoModelName;
      case 'sysinfoModelIdentifier';
        return $this->sysinfoModelIdentifier;
      case 'sysinfoProcessorName';
        return $this->sysinfoProcessorName;
      case 'sysinfoProcessorSpeed';
        return $this->sysinfoProcessorSpeed;
      case 'sysinfoNumProcessors';
        return $this->sysinfoNumProcessors;
      case 'sysinfoNumCores';
        return $this->sysinfoNumCores;
      case 'sysinfoPhysicalMemory';
        return $this->sysinfoPhysicalMemory;
      case 'summary';
        return $this->summary;
      case 'trace';
        return $this->trace;
      case 'symbolicatedTrace';
        return $this->symbolicatedTrace;
      case 'userComment';
        return $this->userComment;
      case 'uid';
        return $this->uid;
      case 'isRead';
        return $this->isRead;
      case 'createdAt';
        return $this->createdAt;
      case 'updatedAt';
        return $this->updatedAt;
    }
    
    return null;    
  }
}