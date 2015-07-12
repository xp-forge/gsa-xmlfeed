<?php namespace com\google\gsa\feed\unittest;

use com\google\gsa\feed\UrlRecord;
use xml\Node;

/**
 * Tests UrlRecord implementation
 */
class UrlRecordTest extends \unittest\TestCase {

  #[@test]
  public function url() {
    $this->assertEquals('http://localhost/', (new UrlRecord('http://localhost/'))->getUrl());
  }

  #[@test]
  public function visit() {
    $n= new Node('record');
    (new UrlRecord('http://localhost/'))->visit($n);
    $this->assertEquals(new Node('record', null, ['url' => 'http://localhost/']), $n);
  }
}
