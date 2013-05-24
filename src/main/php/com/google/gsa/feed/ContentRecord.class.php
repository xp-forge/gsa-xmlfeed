<?php namespace com\google\gsa\feed;
 
use xml\CData;

/**
 * Record with content
 *
 * @test  xp://com.google.gsa.feed.ContentRecordTest
 */
class ContentRecord extends Record {
  protected $content;
  protected $mimeType;

  /**
   * Creates a new record
   *
   * @param  string url
   * @param  string mimeType
   * @param  string content
   */
  public function __construct($url, $mimeType= null, $content= null) {
    parent::__construct($url);
    $this->mimeType= $mimeType;
    $this->content= $content;
  }

  /**
   * Sets this document's mime type
   *
   * @param  string mimeType
   * @return self
   */
  public function withMimeType($mimeType) {
    $this->mimeType= $mimeType;
    return $this;
  }

  /**
   * Sets this document's content
   *
   * @param  string content
   * @return self
   */
  public function withContent($content) {
    $this->content= $content;
    return $this;
  }

  /**
   * Gets this document's mime type
   *
   * @return string
   */
  public function getMimeType() {
    return $this->mimeType;
  }

  /**
   * Gets this document's content
   *
   * @return string
   */
  public function getContent() {
    return $this->content;
  }

  /**
   * Create node for XML feed
   *
   * @param  xml.Node node
   */
  public function visit(\xml\Node $n) {
    parent::visit($n);
    $n->setAttribute('mimetype', $this->mimeType);
    $n->addChild(new \xml\Node('content', new CData($this->content)));
  }
}
