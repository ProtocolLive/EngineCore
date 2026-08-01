<?php
//Protocol Corporation Ltda.

namespace ProtocolLive\EngineCore\Core;
use HttpCode;

/**
 * @version 2026.07.24.00
 */
abstract class Route{
  public static function Route(
    string $Project
  ):Response{
    DebugTrace();
    if(isset($_SERVER['PATH_INFO'])):
      $rota = explode('/', $_SERVER['PATH_INFO']);
      if(empty($rota[1])):
        $rota[1] = 'Index';
      endif;
      if(empty($rota[2])):
        $rota[2] = 'Index';
      endif;
    else:
      $rota = [null, 'Index', 'Index'];
    endif;

    $cls = 'ProtocolLive\\' . $Project . '\Controllers\\' . $rota[1];
    $mth = 'Route_' . $rota[2];
    if(($_SERVER['REQUEST_METHOD'] ?? null) === 'POST'
    and Csrf(true) === false):
      error_log('CSRF falso');
      return new Response(Code: HttpCode::BadRequest);
    endif;
    if(method_exists($cls, $mth) === false):
      error_log('Rota não encontrada: ' . $cls . '::' . $mth);
      return new Response(Code: HttpCode::NotFound);
    endif;
    if(in_array(AuthInterface::class, class_implements($cls))
    and $cls::Auth() === false):
      $cls = 'ProtocolLive\\' . $Project . '\Controllers\Index';
      $mth = 'Route_Index';
    endif;
    return call_user_func($cls . '::' . $mth);
  }
}