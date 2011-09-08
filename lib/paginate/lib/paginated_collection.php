<?php

class PaginatedCollection implements Iterator {
  
  private $items;
  private $totalItems;
  private $currentPage;
  private $itemsPerPage;
  private $totalPages;
  private $previousPage;
  private $nextPage;
  private $pages;
  
  public function __construct(Array $items, $total_items, $current_page, $items_per_page) {
    if ($current_page === 0) {
      $current_page = 1;
    }
    
    $this->items = $items;
    $this->totalItems = $total_items;    
    $this->currentPage = $current_page;
    $this->itemsPerPage = $items_per_page;
    
    $this->totalPages = (int)ceil($total_items / $items_per_page);
    $this->previousPage = max($current_page - 1, 1);
    $this->nextPage = min($current_page + 1, $this->totalPages);
  }
  
  public static function offset($current_page, $items_per_page) {
    if ($current_page <= 1) {
      return 0;
    }
    
    return ($current_page - 1) * $items_per_page;
  }
  
  public function getItems() {
    return $this->items;
  }
  
  public function getTotalItems() {
    return $this->totalItems;
  }
  
  public function getCurrentPage() {
    return $this->currentPage;
  }
  
  public function getItemsPerPage() {
    return $this->itemsPerPage;
  }
  
  public function getTotalPages() {
    return $this->totalPages;
  }
  
  public function getPreviousPage() {
    return $this->previousPage;
  }
  
  public function getNextPage() {
    return $this->nextPage;
  }
  
  public function getPages() {
    if ($this->pages === null) {
      $this->pages = new PageNumbers($this->currentPage, $this->totalPages);
    }
    
    return $this->pages;
  }
  
  public function __get($name) {
    switch($name) {
      case 'items':
        return $this->getItems();
      case 'totalItems':
        return $this->getTotalItems();
      case 'currentPage':
        return $this->getCurrentPage();
      case 'itemsPerPage':
        return $this->getItemsPerPage();
      case 'totalPages':
        return $this->getTotalPages();
      case 'previousPage':
        return $this->getPreviousPage();
      case 'nextPage':
        return $this->getNextPage();
      case 'pages':
        return $this->getPages();
    }
    
    return null;
  } 
  
  public function rewind() {
    reset($this->items);
  }

  public function valid() {
    return current($this->items);
  }

  public function key() {
    return key($this->items);
  }

  public function current() {
    return current($this->items);
  }

  public function next() {
    return next($this->items);
  }
}

// EOF
