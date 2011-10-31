<?php

/**
 Example for a worker. A worker is a CLI script that has full access to all 
 components of the app (database, models, libraries...) thus can be easily
 used to construct background jobs for cron or alike.
*/

require_once ((realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR))
  . DIRECTORY_SEPARATOR . 'init.php');

// Do work
