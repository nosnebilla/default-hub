<?php

// PHP version >= 5.3
// memory_limit >= 32M
// max_execution_time >= 30
// register_globals == 0
// upload_max_filesize >= 8M
// expose_php == 0
// magic_quotes_gpc == 0
// safe_mode == 0
// mbstring loaded
// suhosin?

if (ini_get('magic_quotes_gpc') == 1) {
  throw new Exception("PHP ini setting `magic_quotes_gpc` needs to be turned off.");
}

if (ini_get('magic_quotes_runtime') == 1) {
  throw new Exception("PHP ini setting `magic_quotes_runtime` needs to be turned off.");
}

# EOF