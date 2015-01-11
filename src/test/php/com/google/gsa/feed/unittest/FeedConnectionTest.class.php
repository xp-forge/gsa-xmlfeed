<?php namespace com\google\gsa\feed\unittest;

use com\google\gsa\feed\FeedConnection;
use com\google\gsa\feed\XmlFeed;
use com\google\gsa\feed\FeedType;
use peer\http\HttpConnection;
use peer\http\HttpRequest;
use peer\http\HttpResponse;
use peer\URL;
use io\streams\MemoryInputStream;

/**
 * Tests FeedConnection implementation
 */
class FeedConnectionTest extends \unittest\TestCase {

  #[@test]
  public function string_constructor_variant() {
    $url= 'http://localhost:19900';
    $this->assertEquals(
      new URL($url),
      (new FeedConnection($url))->getConnection()->getUrl()
    );
  }

  #[@test]
  public function connection_constructor_variant() {
    $url= 'http://localhost:19900';
    $this->assertEquals(
      new URL($url), 
      (new FeedConnection(new HttpConnection($url)))->getConnection()->getUrl()
    );
  }

  /**
   * Assertion helper 
   *
   * @param  string expected
   * @param  string actual
   * @throws unittest.AssertionFailedError
   */
  protected function assertXmlEquals($expected, $actual) {
    $this->assertEquals(
      preg_replace('/[\s\t\r\n]+/', '', $expected),
      preg_replace('/[\s\t\r\n]+/', '', $actual)
    );
  }

  #[@test]
  public function full_feed_payload() {
    $this->assertXmlEquals(
      '<?xml version="1.0" encoding="UTF-8"?>
      <!DOCTYPE gsafeed PUBLIC "-//Google//DTD GSA Feeds//EN" "">
      <gsafeed>
        <header>
          <datasource>test</datasource>
          <feedtype>full</feedtype>
        </header>
        <group/>
      </gsafeed>
      ',
      (new FeedConnection('http://localhost:19900'))->payload(new XmlFeed('test', FeedType::$FULL))
    );
  }

  #[@test]
  public function incremental_feed_payload() {
    $this->assertXmlEquals(
      '<?xml version="1.0" encoding="UTF-8"?>
      <!DOCTYPE gsafeed PUBLIC "-//Google//DTD GSA Feeds//EN" "">
      <gsafeed>
        <header>
          <datasource>test</datasource>
          <feedtype>incremental</feedtype>
        </header>
        <group/>
      </gsafeed>
      ',
      (new FeedConnection('http://localhost:19900'))->payload(new XmlFeed('test', FeedType::$INCREMENTAL))
    );
  }

  #[@test]
  public function publish() {
    $conn= newinstance('peer.http.HttpConnection', ['http://localhost:19900'], [
      'requests' => [],
      'responses' => [],
      'send' => function(HttpRequest $r) {
        $this->requests[]= $r;
        return array_shift($this->responses);
      }
    ]);
    $conn->responses[]= new HttpResponse(new MemoryInputStream("HTTP/1.1 200 OK\r\n\r\n"));
    (new FeedConnection($conn))->publish(new XmlFeed('test', FeedType::$INCREMENTAL));
    $this->assertEquals(
      "POST /xmlfeed HTTP/1.1\r\n".
      "Connection: close\r\n".
      "Host: localhost:19900\r\n".
      "Content-Type: multipart/form-data; boundary=----------boundary_of_feed_data\$\r\n".
      "Content-Length: 598\r\n\r\n",
      $conn->requests[0]->getHeaderString()
    );
  }
}
