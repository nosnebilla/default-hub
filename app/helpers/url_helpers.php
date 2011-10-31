<?php

function home_url() {
  return "/";
}

function crash_reports_url($id = 0) {
  if ($id > 0) {
    return sprintf("/crashreports/%d", $id);
  }
  
  return "/crashreports";
}

function error_cases_url($id = 0) {
  if ($id > 0) {
    return sprintf("/errorcases/%d", $id);
  }
  
  return "/errorcases";
}

function symbolicate_url() {
  return "/symbolicate";
}