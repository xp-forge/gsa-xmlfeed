<?php namespace com\google\gsa\feed;

/**
 * Record with URL only
 *
 * @test  xp://com.google.gsa.feed.UrlRecordTest
 */
class UrlRecord extends Record {

  /**
   * Create node for XML feed
   *
   * @param  xml.Node n
   */
  public function visit(\xml\Node $n) {
    parent::visit($n);
  }
}
