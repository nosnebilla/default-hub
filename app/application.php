<?php

require_once LIB_DIR . DS . 'action_pack/action_pack.php';
require_once APP_HELPERS_DIR . DS . 'application_view_helpers.php';
require_once APP_MAILERS_DIR . DS . 'errors_mailer.php';

class UnknownEnvironmentApplicationException extends Exception {}

class Application {

  const DEFAULT_LOCALE = 'de_DE';
  const DEFAULT_TIME_ZONE = 'Europe/Berlin';

  private static $instance;
  private $currentEnvironment;
  private $environments;
  private $name;
  private $locale;
  private $timeZone;  
  private $logger;
  private $request;
    
  public static function instance() {
    if (!self::$instance) {
      self::$instance = new Application();
    }

    return self::$instance;
  }
  
  public static function dispatch(Request $request = null, Response $response = null) {
    if ($request === null) {
      $request = new Request();
    }
    
    if ($response === null) {
      $response = new Response();
    }
    
    $app = self::instance();
    $app->setRequest($request);

    $dispatcher = new Dispatcher(APP_CONTROLLERS_DIR);
    $dispatcher->dispatch($request, $response);
    $response->send();
  }
  
  public static function handleException(Exception $exception) {
    // Log exception
    $logger = Application::instance()->logger();

    if ($logger !== null) {
      $msg = sprintf("%s: %s", get_class($exception), $exception->getMessage());  

      try {
        $logger->error($msg);
      } catch (Exception $e) {
        // Ignore exception, it will be handled next time
      }
    }

    // Mail exception
    $errorsMailer = new ErrorsMailer();

    try {
      $errorsMailer->deliverErrorMail($exception);
    } catch (Exception $e) {
      // Ignore exception, it will be handled next time
    }

    // Render exception for development and show 500 page in production
    try {
      if (is_development()) {
        $format = is_cli() ? 'txt' : 'html';
        $view_template = sprintf('errors/exception.%s.php', $format);
        $request = new Request();
        $view = new View(APP_VIEWS_DIR, $view_template, array('exception' => $exception, 'request' => $request));    
        $response = new Response();
        $response->statusCode = 500;
        $response->body = $view->render();
        $response->send();
      } else {
        if (!is_cli()) {
          $view = new View(PUBLIC_DIR, '500.html');      
          $response = new Response();
          $response->statusCode = 500;
          $response->body = $view->render();
          $response->send();
        }
      }
    } catch (Exception $e) {
      echo $e->getMessage();
    }  

    exit;
  }
  
  public function __construct() {
    $this->environments = array('development', 'production', 'testing');
    $this->currentEnvironment = 'production';
    $this->timeZone = self::DEFAULT_TIME_ZONE;
    date_default_timezone_set($this->timeZone);
    $this->locale = self::DEFAULT_LOCALE;
  }
    
  public function name() {
    return $this->getName();
  }
  
  public function getName() {
    return $this->name;
  }
  
  public function setName($name) {
    $this->name = $name;
  }
  
  public function locale() {
    return $this->getLocale();
  }
  
  public function getLocale() {
    return $this->locale;
  }
  
  public function setLocale($locale) {
    $this->locale = $locale;
  }

  public function timeZone() {
    return $this->getTimeZone();
  }
  
  public function getTimeZone() {
    return $this->timeZone;
  }

  public function setTimeZone($timeZone) {
    $this->timeZone = $timeZone;
    date_default_timezone_set($this->timeZone);
  }

  public function env() {
    return $this->getEnvironment();
  }
  
  public function environment() {
    return $this->getEnvironment();
  }
  
  public function getEnvironment() {
    return $this->currentEnvironment;
  }

  public function isEnvironment($name) {
    return ($this->currentEnvironment === $name);
  }

  public function addEnvironment($name, $options) {
    $this->environments[$name] = $options;
  }

  public function addEnvironments($envs) {
    $this->environments = array_merge($this->environments, $envs);
  }

  public function setEnvironments(Array $envs) {
    $this->environments = $envs;
  }

  public function setEnvironment($env) {
    if (!in_array($env, $this->environments)) {
      throw new UnknownEnvironmentApplicationException($env);
    }

    $this->currentEnvironment = $env;
  }
  
  public function setEnvironmentWithContentsFromFile($filepath) {
    if (file_exists($filepath)) {
      $env = trim(file_get_contents($filepath));
      $this->setEnvironment($env);
    }
  }
  
  public function logger() {
    return $this->getLogger();
  }
  
  public function getLogger() {
    return $this->logger;
  }
  
  public function setLogger(Logger $logger) {
    $this->logger = $logger;
  }
  
  public function request() {
    return $this->getRequest();
  }
  
  public function getRequest() {
    return $this->request;
  }

  public function setRequest(Request $request) {
    $this->request = $request;
  }

  public function __get($attrib) {
    switch($attrib) {
      case 'name':
        return $this->getName();
      case 'request':
        return $this->getRequest();
      case 'env':
        return $this->getEnvironment();
      case 'environment':
        return $this->getEnvironment();
      case 'locale':
        return $this->getLocale();
      case 'timeZone':
        return $this->getTimeZone();
    }
    
    return null;
  }
}
