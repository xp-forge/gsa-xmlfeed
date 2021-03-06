<?php namespace com\google\gsa\feed;

/**
 * Represents the XML Feed payload
 *
 * @test  xp://com.google.gsa.feed.XmlFeedTest
 */
class XmlFeed extends \lang\Object {
  protected $dataSource;
  protected $feedType;
  protected $records= array('add' => array(), 'delete' => array());

  /**
   * Creates a new XML Feed
   *
   * @param  string dataSource
   * @param  com.google.gsa.feed.FeedType feedType
   */
  public function __construct($dataSource, FeedType $feedType) {
    $this->dataSource= $dataSource;
    $this->feedType= $feedType;
  }

  /**
   * Get dataSource
   *
   * @return  string
   */
  public function dataSource() {
    return $this->dataSource;
  }

  /**
   * Get feedType
   *
   * @return  com.google.gsa.feed.FeedType
   */
  public function feedType() {
    return $this->feedType;
  }

  /**
   * Add a record
   * 
   * @param  string action
   * @param  com.google.gsa.feed.Record record
   * @return com.google.gsa.feed.Record the added record
   * @throws lang.IllegalArgumentException when then action is unknown
   */
  public function addRecord($action, Record $record) {
    if (!isset($this->records[$action])) {
      throw new \lang\IllegalArgumentException('Unknown action '.$action.', should be one of '.implode(', ', array_keys($this->records)));
    }
    $this->records[$action][]= $record;
    return $record;
  }

  /**
   * Add a record and return this XML feed instance.
   * 
   * @param  string action
   * @param  com.google.gsa.feed.Record record
   * @return self this
   * @throws lang.IllegalArgumentException when then action is unknown
   */
  public function withRecord($action, Record $record) {
    $this->addRecord($action, $record);
    return $this;
  }

  /**
   * Retrieve the number of records
   *
   * @return  int
   */
  public function numRecords() {
    return sizeof($this->records['add']) + sizeof($this->records['delete']);
  }

  /**
   * Get all records
   *
   * @return  com.google.gsa.feed.Record[]
   */
  public function getRecords() {
    return array_merge($this->records['add'], $this->records['delete']);
  }
}
