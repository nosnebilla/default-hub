<?php

require_once APP_HELPERS_DIR . '/application_helpers.php';
require_once APP_HELPERS_DIR . '/application_view_helpers.php';
require_once APP_HELPERS_DIR . '/url_helpers.php';

abstract class ApplicationController extends ActionController {

  public function beforeFilter() {
    $this->initView();
    $this->initViewFormats();
  }

  public function afterFilter() {
  }

  protected function beforeRender() {
  }

  protected function afterRender() {
    //$this->setETag();
  }
  
  final protected function validateAPIToken() {
    return ($this->params['token'] == Config::get('app.ini', 'api.token'));
  }

  final protected function initView() {
    $this->setViewBasePath(APP_VIEWS_DIR);
  }

  protected function initViewFormats() {
    $this->registerViewFormat('iphone', 'text/html');
  }

  final protected function setETag() {
    $etag = etag($this->response->body);
    $this->response->setETagHeader($etag);

    if ($this->request->hasMatchingETag($etag)) {
      $this->response->statusCode = 304;
      $this->response->body = null;
    }
  }
}

# EOF