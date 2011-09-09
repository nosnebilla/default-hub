<?php

if (!is_production()) {
  ini_set('display_errors', 1);  
}

set_error_handler('exception_error_handler');
set_exception_handler('exception_handler');
