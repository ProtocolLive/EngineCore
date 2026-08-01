<?php
//Protocol Corporation Ltda.
//2026.07.27.00

use ProtocolLive\EngineCore\Core\Route;

require(dirname(__DIR__) . '/system/system.php');

$return = Route::Route();

foreach($return->Headers as $header):
  header($header);
endforeach;
if(headers_sent() === false):
  http_response_code($return->Code);
endif;
if($return->Msg !== null):
  echo $return->Msg;
endif;