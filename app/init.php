<?php

require_once 'defines.php';

// Adjust default PHP settings
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
ini_set('session.use_trans_sid', 0);
ini_set('expose_php', 0);

// Application initialization
require_once 'application.php';

$app = Application::instance();
$app->setEnvironmentWithContentsFromFile(CONFIG_DIR . DS . 'environment');

require_once APP_HELPERS_DIR . '/application_helpers.php';

// Other initializations
include INIT_DIR . '/config.php';
include INIT_DIR . '/error_handling.php';
include INIT_DIR . '/logging.php';
include INIT_DIR . '/check_settings.php';

if (!is_cli()) {
  include INIT_DIR . '/default_includes.php';
}

include INIT_DIR . '/tmp_files.php';
include INIT_DIR . '/db.php';

# EOF
