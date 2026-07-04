<?php
//Protocol Corporation Ltda.

namespace ProtocolLive\SuperLauda\Core;

/**
 * @version 2026.06.22.00
 */
abstract class Helper{
  public static function Logged():bool{
    DebugTrace();
    return isset($_SESSION['user']);
  }
}