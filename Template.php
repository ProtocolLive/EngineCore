<?php
//Protocol Corporation Ltda.

namespace ProtocolLive\SuperLauda\Core;
use DomainException;

/**
 * @version 2026.07.19.00
 */
final class Template{
  private string $Template;

  /**
   * @throws DomainException
   */
  public function __construct(
    public readonly string $Dir,
    string $Template = 'default'
  ){
    DebugTrace();
    if(is_dir($Dir . '/' . $Template) === false):
      throw new DomainException('Pasta de template ' . $Template . ' não encontrada');
    endif;
    $this->Template = $Template;
  }

  public function Get(
    string $File,
    array $Variables = [],
    bool $Root = false,
    bool $Return = true
  ):string|bool{
    DebugTrace();
    extract($Variables);
    ob_start();
    if($Root):
      $file = $this->Dir . '/' . $this->Template . '/' . $File;
      if(is_file($file) === false):
        error_log('Template file ' . $file . ' not found');
        return false;
      endif;
      require $file;
    else:
      $temp = debug_backtrace();
      $temp = basename($temp[0]['file'], '.php');
      $file = $this->Dir . '/' . $this->Template . '/' . $temp . '/' . $File;
      if(is_file($file) === false):
        error_log('Ftemplate file ' . $file . ' not found');
        return false;
      endif;
      require $file;
    endif;
    if($Return):
      $return = ob_get_contents();
      ob_end_clean();
      return $return;
    else:
      ob_end_flush();
      return true;
    endif;
  }

  public function DirGet():string{
    DebugTrace();
    return $this->Dir . '/' . $this->Template;
  }

  public function TemplateGet():string{
    DebugTrace();
    return $this->Template;
  }

  public function TemplateSet(string $Template):void{
    DebugTrace();
    if(is_dir($this->Dir . '/' . $Template) === false):
      throw new DomainException('Pasta do template não encontrada');
    endif;
    $this->Template = $Template;
  }
}