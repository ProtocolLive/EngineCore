<?php
//Protocol Corporation Ltda.

namespace ProtocolLive\SuperLauda\Core;
use HttpCode;

/**
 * @version 2026.07.04.00
 */
final class Response{
  public function __construct(
    public string|null $Msg = null,
    public int|HttpCode $Code = 200,
    public string|null $Headers = null
  ){
    DebugTrace();
    $this->Code = $Code->value ?? $Code;
  }
}