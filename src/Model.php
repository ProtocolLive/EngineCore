<?php
//Protocol Corporation Ltda.

namespace ProtocolLive\SuperLauda\Models;
use ProtocolLive\PhpLiveDb\PhpLiveDb;

/**
 * @version 2026.03.30.00
 */
abstract class Model{
  protected static PhpLiveDb|null $Db = null;

  protected static function Construct():void{
    DebugTrace();
    if(self::$Db === null):
      $config = require(DirConfig . '/database.php');
      self::$Db = new PhpLiveDb($config['DbServer'], $config['DbUser'], $config['DbPwd'], $config['DbDatabase']);
    endif;
  }
}