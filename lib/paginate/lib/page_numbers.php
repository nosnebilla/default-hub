<?php

class PageNumbers implements Iterator {
  
  const DEFAULT_PAGE_PADDING = 2;
  
  private $currentPage;
  private $totalPages;
  private $pagePadding;
  private $pages;
  
  public function __construct($current_page, $total_pages) {
    $this->pagePadding = self::DEFAULT_PAGE_PADDING;
    $this->currentPage = $current_page;
    $this->totalPages = $total_pages;
    
    $this->buildPages();
  }
  
  public function getCurrentPage() {
    return $this->currentPage;
  }
  
  public function getTotalPages() {
    return $this->totalPages;
  }
  
  public function getPagePadding() {
    return $this->pagePadding;
  }
  
  public function getPages() {
    return $this->pages;
  }
  
  public function isFirstPageAfterSkippedRange($page) {
    
  }
  
  public function rewind() {
    reset($this->pages);
  }

  public function valid() {
    return current($this->pages);
  }

  public function key() {
    return key($this->pages);
  }

  public function current() {
    return current($this->pages);
  }

  public function next() {
    return next($this->pages);
  }
  
  public function __get($name) {
    switch ($name) {
      case 'currentPage':
        return $this->getCurrentPage();
      case 'totalPages':
        return $this->getTotalPages();
      case 'pagePadding':
        return $this->getPagePadding();
      case 'pages':
        return $this->getPages();
    }
    
    return null;
  }
  
  private function buildPages() {
    $pages = array();
    
    for ($i = 1; $i <= $this->totalPages; $i++) {
      if ($i == 1
         || $i == $this->totalPages
         || ($i >= ($this->currentPage - $this->pagePadding) && $i <= ($this->currentPage + $this->pagePadding))
      ) {
        if (count($pages) > 0 && ($i - 1) !== $pages[count($pages) - 1]) {
          $pages[] = -1;
        }
           
        $pages[] = $i;
      }
    }
    
    $this->pages = $pages;
  }
}

# EOF
