<?php
//Protocol Corporation Ltda.

namespace ProtocolLive\SuperLauda\Core;
use HttpCode;

/**
 * @version 2026.07.27.00
 */
final class Response{
  public function __construct(
    public string|null $Msg = null,
    public int|HttpCode $Code = 200,
    public string|array|null $Headers = null
  ){
    DebugTrace();
    $this->Code = $Code->value ?? $Code;
    if(is_string($Headers)):
      $Headers = [$Headers];
    endif;
  }
}