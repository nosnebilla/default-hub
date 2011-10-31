<?php

require_once LIB_DIR . '/action_mailer/action_mailer.php';

class ApplicationMailer extends ActionMailer {
      
  protected function beforeDeliver() {
    $this->sender = Config::get('app.ini', 'mailer.default_from_address');
    $this->addRecipient(Config::get('app.ini', 'mailer.default_to_address'));
    
    if (is_development()) { 
      //$this->sender = Config::get('development.ini', 'mailer.default_from_address');
      //$this->addRecipient(Config::get('development.ini', 'mailer.default_to_address'));
      $this->deliveryType = self::DELIVERY_TYPE_LOCAL_FOLDER;
      $this->mailFolder = TMP_DIR;
    }
  }
    
  protected function afterDeliver() {    
  }
}

// EOF