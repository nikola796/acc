<?php
namespace App\Core;

class Exception
{
    protected $message = 'Неизвестно изключение';   // съобщение на изключението
    protected $code = 0;                            // потребителски дефиниран код на изключението
    protected $file;                                // име на файл с кода на изключението
    protected $line;                                // ред в кода на изключението

    function __construct($message = null, $code = 0){}

    final function getMessage(){}               // съобщение на изключението
    final function getCode(){}                   // код на изключението
    final function getFile(){}                  // име на файл с кода
    final function getLine(){}                   // ред в кода
    final function getTrace(){}                  // масив с backtrace() - обратно проследяване
    final function getTraceAsString(){}          // форматиран низ на проследяването

    /* Предифинируем */
    function __toString(){}                       // форматиран низ за показване                       // форматиран низ за показване
}

