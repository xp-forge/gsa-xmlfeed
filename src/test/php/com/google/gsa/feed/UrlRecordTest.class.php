<?php namespace com\google\gsa\feed;
 
/**
 * Tests UrlRecord implementation
 */
class UrlRecordTest extends \unittest\TestCase {

  #[@test]
  public function url() {
    $this->assertEquals('http://localhost/', create(new UrlRecord('http://localhost/'))->getUrl());
  }

  #[@test]
  public function visit() {
    $n= new \xml\Node('record');
    create(new UrlRecord('http://localhost/'))->visit($n);
    $this->assertEquals(
      new \xml\Node('record', null, array('url' => 'http://localhost/')), 
      $n
    );
  }
}
