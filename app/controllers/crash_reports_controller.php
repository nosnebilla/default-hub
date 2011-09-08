<?php

require_once APP_DIR . DS . 'application_controller.php';
require_once APP_HELPERS_DIR . '/crash_reports_helpers.php';
require_once APP_MODELS_DIR . '/crash_report.php';
require_once APP_MODELS_DIR . '/symbolicator.php';

class CrashReportsController extends ApplicationController {
  
  public function index() {
    $this->crash_reports = CrashReport::findAll();
  }
  
  public function show($id) {
    $this->crash_report = CrashReport::findById($id);
    
    $symbolicator = new Symbolicator($this->crash_report->summary, 'tower1', $this->crash_report->appVersion);
    $this->symbolicated_report = null;
    $this->symbolicator_error_message = null;
    
    try {
      $this->symbolicated_report = $symbolicator->symbolicate();
    } catch (Exception $e) {
      $this->symbolicator_error_message = markdown_to_html($e->getMessage());
    }
  }
  
  public function symbolicate() {
    $this->symbolicated_report = null;
    $this->symbolicator_error_message = null;
    
    if (is_post_request()) {
      $symbolicator = new Symbolicator($this->params['report'], 'tower1');
      
      try {
        $this->symbolicated_report = $symbolicator->symbolicate();
      } catch (Exception $e) {
        $this->symbolicator_error_message = markdown_to_html($e->getMessage());
      }
    }
  }
}
