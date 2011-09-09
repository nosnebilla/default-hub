<?php

require_once realpath(dirname(__FILE__) . '/../lib/page_numbers.php');
  
class PageNumbersTest extends PHPUnit_Framework_TestCase {

  public function test() {
    $page_numbers = new PageNumbers(5,10);
    $expected_pages = array(1,0,3,4,5,6,7,0,10);
    $this->assertEquals($expected_pages, $page_numbers->pages);

    $page_numbers = new PageNumbers(4,7);
    $expected_pages = array(1,2,3,4,5,6,7);
    $this->assertEquals($expected_pages, $page_numbers->pages);
    
    $page_numbers = new PageNumbers(6,7);
    $expected_pages = array(1,0,4,5,6,7);
    $this->assertEquals($expected_pages, $page_numbers->pages);
    
    $page_numbers = new PageNumbers(3,3);
    $expected_pages = array(1,2,3);
    $this->assertEquals($expected_pages, $page_numbers->pages);
    
    $page_numbers = new PageNumbers(1,1);
    $expected_pages = array(1);
    $this->assertEquals($expected_pages, $page_numbers->pages);
  }
}
