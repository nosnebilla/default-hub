<?php

require_once APP_DIR . DS . 'application_controller.php';

class ErrorsController extends ApplicationController {
  
  public function httpError($status_code) {
    $this->response->statusCode = $status_code;
    $this->layout = null;
    $this->view = PUBLIC_DIR . "/{$status_code}.html";
  }
}
