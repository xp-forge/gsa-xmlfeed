<?php namespace com\google\gsa\feed;
 
/**
 * Feed types enumeration
 */
class FeedType extends \lang\Enum {
  public static $INCREMENTAL, $FULL;

  static function __static() {
    self::$INCREMENTAL= new self(1, 'incremental');
    self::$FULL= new self(2, 'full');
  }
}
