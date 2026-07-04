<?php
//Protocol Corporation Ltda.

namespace ProtocolLive\SuperLauda\Core;
use HttpCode;

/**
 * @version 2026.07.04.00
 */
abstract class Route{
  public static function Route():Response{
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

    $cls = 'ProtocolLive\SuperLauda\Controllers\\' . $rota[1];
    $mth = 'Route_' . $rota[2];
    if(($_SERVER['REQUEST_METHOD'] ?? null) === 'POST'
    and Csrf(true) === false):
      error_log('CSRF falso');
      return new Response(Code: HttpCode::BadRequest);
    endif;
    if(method_exists($cls, $mth) === false):
      error_log('Não encontrado: ' . $cls . '::' . $mth);
      return new Response(Code: HttpCode::NotFound);
    endif;
    if(in_array(AuthInterface::class, class_implements($cls))
    and Helper::Logged() === false):
      $cls = 'ProtocolLive\SuperLauda\Controllers\Index';
      $mth = 'Route_Index';
    endif;
    return call_user_func($cls . '::' . $mth);
  }
}