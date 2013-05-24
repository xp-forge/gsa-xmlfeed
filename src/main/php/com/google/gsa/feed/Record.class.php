<?php namespace com\google\gsa\feed;

/**
 * Base class for feed records
 *
 * @see  xp://com.google.gsa.feed.UrlRecord
 * @see  xp://com.google.gsa.feed.ContentRecord
 */
abstract class Record extends \lang\Object {
  protected $url;
  protected $lastModified= null;

  /**
   * Creates a new record
   *
   * @param  string url
   */
  public function __construct($url) {
    $this->url= $url;
  }

  /**
   * Gets this record's URL
   *
   * @return  string
   */
  public function getUrl() {
    return $this->url;
  }

  /**
   * Sets last-modified date
   *
   * @param  util.Date lastModified
   * @return self
   */
  public function lastModified(\util\Date $lastModified= null) {
    $this->lastModified= $lastModified;
    return $this;
  }

  /**
   * Create node for XML feed
   *
   * @param  xml.Node n
   */
  public function visit(\xml\Node $n) {
    $n->setAttribute('url', $this->url);
    $this->lastModified && $n->setAttribute('last-modified', $this->lastModified->toString('r'));
  }
}
