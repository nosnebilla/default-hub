<?php

class ReleaseNotFoundSymbolicatorException extends Exception {}
class UnknownReportFormatSymbolicatorException extends Exception {}

class Symbolicator {
  
  private $report;
  private $appIdentifier;
  private $appVersion;
  private $arch;
  
  public function __construct($report, $app_identifier = 'tower1', $app_version = null, $arch = 'x86_64') {
    $this->report = $report;
    $this->appIdentifier = $app_identifier;
    $this->appVersion = $app_version;
    $this->arch = $arch;
  }
    
  public function getReport() {
    return $this->report;    
  }
  
  public function getAppIdentifier() {
    return $this->appIdentifier;    
  }
  
  public function getAppVersion() {
    return $this->appVersion;    
  }
  
  public function getArch() {
    return $this->arch;    
  }
  
  public function symbolicate() {
    $addresses = null;
    $targets = null;
    $matches = null;
    
    $symbolicated_report = $this->report;

    if ($this->appVersion === null) {
      preg_match('/^App Version: ([^\s]+)/m', $symbolicated_report, $matches);
      
      if (!isset($matches[1]) || count($matches[1]) == 0) {
        preg_match('/Version:\s+([\S]+)\s+/m', $symbolicated_report, $matches);
      }
      
      if (!isset($matches[1]) || count($matches[1]) == 0) {
        $msg = "Unknown format of crash or exception report.";
        throw new UnknownReportFormatSymbolicatorException($msg);
      } 
      
      $this->appVersion = $matches[1];
    }
    
    $full_path = sprintf("%s/tower1/%s/Tower.app/Contents/MacOS/Tower", RELEASES_DIR, $this->appVersion); # FIXME
    
    if (!file_exists($full_path)) {
      $msg = "Could not find dsym files for product `{$this->appIdentifier}`, version `{$this->appVersion}`. Please copy dsym files to `releases/PRODUCT/VERSION/`.\n\nFull path: `{$full_path}`";
      throw new ReleaseNotFoundSymbolicatorException($msg);
    }
    
    #
    # Find lines like this: 
    #
    # 1   com.fournova.Tower            	0x00091c91 0x1000 + 593041
    #
    # Resolve address and replace starting address (0x1000) with symbolicated name.
    #
    
    preg_match_all('/[0-9]+\s.+\s(0x[0-9a-f]+)\s(\w+\s\+\s[0-9]+)/m', $this->report, $matches);
    
    if (!isset($matches[1]) || count($matches[1]) == 0) {
      preg_match_all('/^(0x[0-9a-f]+)$/m', $this->report, $matches);
    }
    
    $addresses = $matches[1];
    
    if (isset($matches[2])) {
      $targets = $matches[2]; 
    }
        
    $cmd = sprintf("/usr/bin/atos -arch %s -o %s %s", $this->arch, $full_path, implode(' ', $addresses));
    log_debug($cmd);
    
    $output = null;
    exec($cmd, $output);
        
    foreach ($output as $i => $line) {
      if (substr($line, 0, 2) !== '0x') {
        $replacement = null;
        
        if ($targets !== null) {
          $target = $targets[$i]; // e.g. "0x1000 + 593041"
          $tokens = explode(' + ', $target);      
          $replacement = "{$line} + {$tokens[1]}";
        } else {
          $target = $addresses[$i];
          $replacement = $line;
        }
        
        $symbolicated_report = str_replace($target, $replacement, $symbolicated_report);
      }
    }
    
    return $symbolicated_report;
  }
}