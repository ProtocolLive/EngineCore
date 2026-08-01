<?php
//Protocol Corporation Ltda.

namespace ProtocolLive\EngineCore\Core;
use HttpCode;

/**
 * @version 2026.07.28.00
 */
final class Response{
  public function __construct(
    public string|null $Msg = null,
    public int|HttpCode $Code = 200,
    public string|array $Headers = []
  ){
    DebugTrace();
    $this->Code = $Code->value ?? $Code;
    if(is_string($Headers)):
      $this->Headers = [$Headers];
    endif;
  }
}