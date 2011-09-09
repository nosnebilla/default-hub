<?php

define('DS', DIRECTORY_SEPARATOR);

define('ROOT_DIR', realpath(dirname(__FILE__) . DS . '..'));

define('APP_DIR', ROOT_DIR . DS . 'app');
define('APP_CONTROLLERS_DIR', APP_DIR . DS . 'controllers');
define('APP_MODELS_DIR', APP_DIR . DS . 'models');
define('APP_HELPERS_DIR', APP_DIR . DS . 'helpers');
define('APP_MAILERS_DIR', APP_DIR . DS . 'mailers');
define('APP_VENDOR_DIR', APP_DIR . DS . 'vendor');
define('APP_VIEWS_DIR', APP_DIR . DS . 'views');

define('LIB_DIR', ROOT_DIR . DS . 'lib');
define('CONFIG_DIR', ROOT_DIR . DS . 'config');
define('INIT_DIR', APP_DIR . DS . 'initializers');
define('PUBLIC_DIR', ROOT_DIR . DS . 'public');
define('LOG_DIR', ROOT_DIR . DS . 'log');
define('TMP_DIR', ROOT_DIR . DS . 'tmp');
define('CACHE_DIR', TMP_DIR . DS . 'cache');
define('RELEASES_DIR', ROOT_DIR . DS . 'releases');

# EOF