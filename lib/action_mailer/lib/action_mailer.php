<?php

// TODO: view rendering
// TODO: delivery adapters?

class UnknownDeliveryTypeActionMailerException extends Exception {}

abstract class ActionMailer {
  
  const DELIVERY_TYPE_SENDMAIL = 'SENDMAIL';
  const DELIVERY_TYPE_SMTP = 'SMTP';
  const DELIVERY_TYPE_LOCAL_FOLDER = 'LOCAL_FOLDER';
  
  private $deliveryType;
  private $sender;
  private $recipients;
  private $subject;    
  private $plainTextBody;
  private $plainTextView;
  private $htmlView;
  private $mailFolder;
  
  public function __construct() {
    $this->deliveryType = self::DELIVERY_TYPE_SENDMAIL;
    $this->recipients = array();
    $this->mailFolder = "/tmp/";
  }
  
  abstract protected function beforeDeliver();
  abstract protected function afterDeliver();
  
  protected function getDeliveryType() {
    return $this->deliveryType;
  }
  
  protected function setDeliveryType($deliveryType) {
    $this->deliveryType = $deliveryType;
  }
    
  final protected function deliver() {
    $this->beforeDeliver();
    
    switch ($this->deliveryType) {
      case self::DELIVERY_TYPE_SENDMAIL:
        $headers = "From: {$this->sender}\r\n";
        $headers .= "'Content-type: text/plain; charset=UTF-8\r\n";
        $recipients = implode(', ', $this->recipients);    
        return mail($recipients, $this->subject, $this->plainTextBody, $headers);
      case self::DELIVERY_TYPE_SMTP:
        // TODO
        return false;
        break;
      case self::DELIVERY_TYPE_LOCAL_FOLDER:
        $contents = sprintf("From: %s\n", $this->sender);
        $contents .= sprintf("To: %s\n", implode(', ', $this->recipients));
        $contents .= sprintf("Subject: %s\n\n", $this->subject);
        $contents .= sprintf("%s\n", $this->plainTextBody);        
        $tmpfile = $this->mailFolder . DS . uniqid() . '.msg';
        file_put_contents($tmpfile, $contents);
        return true;
      default:
        $msg = sprintf("Unknown delivery type: %d", $this->deliveryType);
        throw new UnknownDeliveryTypeActionMailerException($msg);
    }
    
    $this->afterDeliver();
  }
  
  final protected function getSender() {
    return $this->sender;
  }
  
  final protected function setSender($sender) {
    $this->sender = $sender;
  }
  
  final protected function getRecipients() {
    return $this->recipients;
  }
    
  final protected function setRecipients(Array $recipients) {
    $this->recipients = $recipients;
  }
  
  final protected function setRecipient($recipient) {
    $this->recipients = array();
    $this->recipients[] = $recipient;
  }
  
  final protected function addRecipient($recipient) {
    if (!in_array($recipient, $this->recipients)) {
      $this->recipients[] = $recipient;
    }
  }
  
  final protected function getSubject() {
    return $this->subject;
  }
  
  final protected function setSubject($subject) {
    $this->subject = $subject;
  }
  
  final protected function getPlainTextBody() {
    return $this->plainTextBody;
  }
  
  final protected function setPlainTextBody($plainTextBody) {
    $this->plainTextBody = $plainTextBody;
  }
  
  final protected function getMailFolder() {
    return $this->mailFolder;
  }
  
  final protected function setMailFolder($mailFolder) {
    $this->mailFolder = $mailFolder;
  }
  
  public function __get($name) {
    switch($name) {
      case 'deliveryType':
        return $this->getDeliveryType();
      case 'sender':
        return $this->getSender();
      case 'recipients':
        return $this->getRecipients();
      case 'subject':
        return $this->getSubject();
      case 'plainTextBody':
        return $this->getPlainTextBody();
     case 'mailFolder':
        return $this->getMailFolder();
      default:
        return null;
    }
  }
  
  public function __set($name, $value) {
    switch($name) {
      case 'deliveryType':
        $this->setDeliveryType($value);
        break;
      case 'sender':
        $this->setSender($value);
        break;
      case 'recipients':
        $this->setRecipients($value);
        break;
      case 'subject':
        $this->setSubject($value);
        break;
      case 'plainTextBody':
        $this->setPlainTextBody($value);
        break;
      case 'mailFolder':
        $this->setMailFolder($value);
        break;
    }
  }
}