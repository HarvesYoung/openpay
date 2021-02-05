<?php

namespace Openpay\Library;

use Throwable;

class Exception implements Throwable
{
  private $code;
  private $message;

  public function __construct($code,$message){
    $this->code    = $code;
    $this->message = $message;
  }

  public function getMessage()
  {
    return $this->message;
  }

  public function getCode()
  {
    return $this->code;
  }

  public function getFile()
  {
    // TODO: Implement getFile() method.
  }

  public function getLine()
  {
    // TODO: Implement getLine() method.
  }

  public function getTrace()
  {
    // TODO: Implement getTrace() method.
  }

  public function getTraceAsString()
  {
    // TODO: Implement getTraceAsString() method.
  }

  public function getPrevious()
  {
    // TODO: Implement getPrevious() method.
  }

  public function __toString()
  {
    return "false";
  }
}
