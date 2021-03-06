gsa-xmlfeed
===========

[![Build Status on TravisCI](https://secure.travis-ci.org/xp-forge/gsa-xmlfeed.svg)](http://travis-ci.org/xp-forge/gsa-xmlfeed)
[![XP Framework Module](https://raw.githubusercontent.com/xp-framework/web/master/static/xp-framework-badge.png)](https://github.com/xp-framework/core)
[![BSD Licence](https://raw.githubusercontent.com/xp-framework/web/master/static/licence-bsd.png)](https://github.com/xp-framework/core/blob/master/LICENCE.md)
[![Required PHP 5.5+](https://raw.githubusercontent.com/xp-framework/web/master/static/php-5_5plus.png)](http://php.net/)
[![Supports PHP 7.0+](https://raw.githubusercontent.com/xp-framework/web/master/static/php-7_0plus.png)](http://php.net/)
[![Supports HHVM 3.4+](https://raw.githubusercontent.com/xp-framework/web/master/static/hhvm-3_4plus.png)](http://hhvm.com/)
[![Latest Stable Version](https://poser.pugx.org/xp-forge/gsa-xmlfeed/version.png)](https://packagist.org/packages/xp-forge/gsa-xmlfeed)


This API lets you speak to the Google Search Appliance's (GSA) feeding API and manage items on indexes either incrementally or as a whole.

Usage example:
--
```php
use com\google\gsa\feed\XmlFeed;
use com\google\gsa\feed\FeedType;
use com\google\gsa\feed\ContentRecord;
use com\google\gsa\feed\FeedConnection;
use com\google\gsa\feed\FeedPublishingException;

$feed= new XmlFeed($this->getClass()->getSimpleName(), FeedType::$INCREMENTAL);
foreach ($records as $record) {
  $feed->addRecord('add', new ContentRecord($record['url'], 'text/html',
    '<html><head>'.
    '<title>'.$record['title'].'</title>'.
    '</head><body>'.
    $record['body'].
    '</body></html>'
  ));
}

try {
  (new FeedConnection('http://gsa-test01.example.com:19900/xmlfeed'))->publish($feed);
} catch (FeedPublishingException $e) {
  // Handle
}
```

API
--
```sh
$ xp -r com.google.gsa.feed
@FileSystemCL<...\xp\gsa-xmlfeed\src\main\php\>
@FileSystemCL<...\xp\gsa-xmlfeed\src\test\php\>
package com.google.gsa.feed {
  package com.google.gsa.feed.unittest

  public enum com.google.gsa.feed.FeedType

  public abstract class com.google.gsa.feed.Record
  public class com.google.gsa.feed.ContentRecord
  public class com.google.gsa.feed.FeedConnection
  public class com.google.gsa.feed.FeedPublishingException
  public class com.google.gsa.feed.UrlRecord
  public class com.google.gsa.feed.XmlFeed
}
```


