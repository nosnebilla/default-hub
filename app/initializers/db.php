<?php

require_once LIB_DIR . DS . 'config/config.php';
require_once LIB_DIR . DS . 'active_record/active_record.php';

# Read database config and initialize model
$config_file = CONFIG_DIR . DS . 'db.ini';

$conf = Config::get($config_file, env());

if ($conf == null) {
  $msg = sprintf("Could not find database config for current environment `%s` in configuration file `%s`.", env(), $config_file);
  throw new Exception($msg);
}

# Create DSN

switch ($conf[ActiveRecordConnections::CONFIG_KEY_DRIVER]) {
  case ActiveRecordConnections::DRIVER_SQLITE:
    $full_db_path = ROOT_DIR . DS . $conf[ActiveRecordConnections::CONFIG_KEY_DATABASE];
        
    if (!file_exists($full_db_path)) {
       throw new Exception("Database '{$full_db_path}' does not exist.");       
    }
    
    $conf[ActiveRecordConnections::CONFIG_KEY_DSN] = "sqlite:{$full_db_path}";
    unset($full_db_path);
    break;
  case ActiveRecordConnections::DRIVER_MYSQL:
    $hostname = $conf[ActiveRecordConnections::CONFIG_KEY_HOSTNAME];
    $database = $conf[ActiveRecordConnections::CONFIG_KEY_DATABASE];
    $conf[ActiveRecordConnections::CONFIG_KEY_DSN] = "mysql:host={$hostname};dbname={$database}";
    break;
}

ActiveRecordConnections::setConnection(ActiveRecordConnections::DEFAULT_CONNECTION, $conf);

unset($conf);
unset($config_file);

# EOF