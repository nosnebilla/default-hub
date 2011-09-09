<?php

require_once APP_DIR . DS . 'application_controller.php';
require_once APP_HELPERS_DIR . '/error_cases_helpers.php';
require_once APP_MODELS_DIR . '/error_case.php';

class ErrorCasesController extends ApplicationController {
  
  public function index() {
    $this->error_cases = ErrorCase::findAll();
  }
  
  public function show($id) {
    $this->error_case = ErrorCase::findById($id);
  }
}
