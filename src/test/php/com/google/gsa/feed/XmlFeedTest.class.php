<?php namespace com\google\gsa\feed;
 
/**
 * Tests XML Feed implementation
 */
class XmlFeedTest extends \unittest\TestCase {

  #[@test]
  public function data_source() {
    $this->assertEquals('test', create(new XmlFeed('test', FeedType::$FULL))->dataSource());
  }

  #[@test]
  public function feed_type() {
    $this->assertEquals(FeedType::$FULL, create(new XmlFeed('test', FeedType::$FULL))->feedType());
  }

  #[@test]
  public function add_record() {
    $feed= new XmlFeed('test', FeedType::$FULL);
    $feed->addRecord('add', new UrlRecord('http://localhost'));
    $this->assertEquals(1, $feed->numRecords());
  }

  #[@test]
  public function add_record_returns_added_record() {
    $feed= new XmlFeed('test', FeedType::$FULL);
    $record= new UrlRecord('http://localhost');
    $this->assertEquals($record, $feed->addRecord('add', $record));
  }

  #[@test]
  public function with_record() {
    $feed= new XmlFeed('test', FeedType::$FULL);
    $feed->withRecord('add', new UrlRecord('http://localhost'));
    $this->assertEquals(1, $feed->numRecords());
  }

  #[@test]
  public function with_record_returns_feed() {
    $feed= new XmlFeed('test', FeedType::$FULL);
    $this->assertEquals($feed, $feed->withRecord('add', new UrlRecord('http://localhost')));
  }

  #[@test]
  public function delete_record() {
    $feed= new XmlFeed('test', FeedType::$FULL);
    $feed->addRecord('delete', new UrlRecord('http://localhost'));
    $this->assertEquals(1, $feed->numRecords());
  }

  #[@test, @expect('lang.IllegalArgumentException')]
  public function add_record_with_unknown_action() {
    $feed= new XmlFeed('test', FeedType::$FULL);
    $feed->addRecord('@@unknown@@', new UrlRecord('http://localhost'));
  }
}
