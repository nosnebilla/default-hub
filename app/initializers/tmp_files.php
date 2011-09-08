<?php

if (!file_exists(TMP_DIR)) {
  $msg = sprintf("Temp directory `%s` does not exist. Please create the temp directory.", TEMP_DIR);
  throw new Exception($msg);
} else if (!is_writable(TMP_DIR)) {
  $msg = sprintf("Temp directory `%s` is not writable for user `%s`. Please change the file permissions on the temp directory.", TMP_DIR, exec('whoami'));
  throw new Exception($msg);  
}

# EOF