<?php

class Config {
  
  static private $baseConfigPath = null;
  
  private function __construct() {}
  
  public static function setBaseConfigPath($path) {
    self::$baseConfigPath = self::removeTrailingSlashFromPath($path);
  }
  
  public static function get($config, $value) {
    $configPath = self::fullPathToConfigFile($config);
    
    if (!file_exists($configPath)) {
      return null;
    }

    $valueKeys = explode('.', $value);    
    $currentConfigValue = parse_ini_file($configPath, true);
    
    foreach ($valueKeys as $key) {
      if (!array_key_exists($key, $currentConfigValue)) {
        return null;
      }
      
      $currentConfigValue = $currentConfigValue[$key];
    }
    
    return $currentConfigValue;
  }
  
  private static function fullPathToConfigFile($config) {
    if (substr($config, 0, 1) === '/') {
      return $config;
    }

    $fullConfigPath = self::$baseConfigPath . DIRECTORY_SEPARATOR . $config;
    return $fullConfigPath;
  }

  private static function removeTrailingSlashFromPath($path) {
    if (substr($path, -1) === DIRECTORY_SEPARATOR) {
      $path = substr($path, 0, -1);
    }

    return $path;
  }  
}