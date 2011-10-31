<?php

require_once APP_DIR . DS . 'application_mailer.php';

class ErrorsMailer extends ApplicationMailer {
  
  protected function beforeDeliver() {
    parent::beforeDeliver();
    $this->setSender(Config::get('app.ini', 'mailer.errors_from_address'));
    $this->setRecipient(Config::get('app.ini', 'mailer.errors_to_address'));
  }
    
  protected function afterDeliver() { 
    parent::afterDeliver(); 
  }
  
  public function deliverErrorMail(Exception $exception) {
    $this->subject = sprintf("Application Error from %s: %s", Config::get('app.ini', 'general.app_name'), get_class($exception));
    $this->plainTextBody = $exception->getMessage();    
    $this->deliver();
  }
}
