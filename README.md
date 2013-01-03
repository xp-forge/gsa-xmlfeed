gsa-xmlfeed
===========
Feed API for Google Search Appliance (GSA)


Usage example (XP Language)
--
```groovy
  $feed= new XmlFeed($this.getClass().getSimpleName(), FeedType::$INCREMENTAL);
  foreach ($record in $records) {
    $feed.addRecord('add', new ContentRecord($record['url'], 'text/html',
      '<html><head>' ~
      '<title>' ~ $record['title'] ~ '</title>' ~
      '</head><body>' ~
      $record['body'] ~
      '</body></html>'
    ));
  }

  try {
    new FeedConnection('http://gsa-test01.example.com:19900/xmlfeed').publish($feed);
  } catch (FeedPublishingException $e) {
    // Handle
  }
```

API
--
```sh
$ xp -r com.google.gsa.feed
@lang.FileSystemClassLoader<...\gsa-xmlfeed\src\main\php\>
@lang.FileSystemClassLoader<...\gsa-xmlfeed\src\test\php\>
package com.google.gsa.feed {

  public enum com.google.gsa.feed.FeedType

  public abstract class com.google.gsa.feed.Record
  public class com.google.gsa.feed.ContentRecord
  public class com.google.gsa.feed.ContentRecordTest
  public class com.google.gsa.feed.FeedConnection
  public class com.google.gsa.feed.FeedConnectionTest
  public class com.google.gsa.feed.FeedPublishingException
  public class com.google.gsa.feed.UrlRecord
  public class com.google.gsa.feed.UrlRecordTest
  public class com.google.gsa.feed.XmlFeed
  public class com.google.gsa.feed.XmlFeedTest
}
```


