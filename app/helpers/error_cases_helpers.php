<?php

function error_cases_api_url($id = 0) {
  $url = sprintf("%s%s", Config::get('app.ini', 'api.base_url'), Config::get('app.ini', 'api.error_cases_url'));
  $token = Config::get('app.ini', 'api.token');
  
  if ($id > 0) {
    $url .= "/{$id}";
  }
  
  $url .= "?token={$token}";
  return $url;
}
