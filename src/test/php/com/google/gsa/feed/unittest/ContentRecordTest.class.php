<?php namespace com\google\gsa\feed\unittest;

use xml\Node;
use xml\CData;
use util\Date;
use util\TimeZone;
use com\google\gsa\feed\ContentRecord;

/**
 * Tests ContentRecord implementation
 */
class ContentRecordTest extends \unittest\TestCase {

  #[@test]
  public function url() {
    $this->assertEquals('http://localhost/', (new ContentRecord('http://localhost/'))->getUrl());
  }

  #[@test]
  public function mimetype() {
    $this->assertEquals('text/html', (new ContentRecord('http://localhost/', 'text/html'))->getMimeType());
  }

  #[@test]
  public function content() {
    $this->assertEquals('test', (new ContentRecord('http://localhost/', 'text/html', 'test'))->getContent());
  }

  #[@test]
  public function visit() {
    $n= new Node('record');
    (new ContentRecord('http://localhost/', 'text/html', 'test'))->visit($n);
    $this->assertEquals(
      create(new Node('record', null, array('url' => 'http://localhost/', 'mimetype' => 'text/html')))
        ->withChild(new Node('content', new CData('test')))
      ,
      $n
    );
  }

  #[@test]
  public function last_modified() {
    $lastModified= new Date('2012-12-07 15:05:00', TimeZone::getByName('Europe/Berlin'));
    $n= new Node('record');
    (new ContentRecord('http://localhost/'))->lastModified($lastModified)->visit($n);
    $this->assertEquals('Fri, 07 Dec 2012 15:05:00 +0100', $n->getAttribute('last-modified'));
  }
}
