<?php

function shorthash($hash) {
  $length = 7;
  
  if (strlen($hash) <= $length) {
    return $hash;
  }
  
  $hash = substr($hash, 0, $length) . '…';
  return $hash;
}

function crash_reports_api_url($id = 0) {
  $url = sprintf("%s%s", Config::get('app.ini', 'api.base_url'), Config::get('app.ini', 'api.crash_reports_url'));
  $token = Config::get('app.ini', 'api.token');
  
  if ($id > 0) {
    $url .= "/{$id}";
  }
  
  $url .= "?token={$token}";
  return $url;
}

function error_case_crash_reports_api_url($id) {
  $url = sprintf("%s%s", Config::get('app.ini', 'api.base_url'), Config::get('app.ini', 'api.error_cases_url'));
  $token = Config::get('app.ini', 'api.token');  
  $url .= "/{$id}/crash_reports";
  $url .= "?token={$token}";
  return $url;
}



