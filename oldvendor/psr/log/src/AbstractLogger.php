<?php

namespace Psr\Log;

use Illuminate\Database\Eloquent\Builder;


/**
 * This is a simple Logger implementation that other Loggers can inherit from.
 *
 * It simply delegates all log-level-specific methods to the `log` method to
 * reduce boilerplate code that a simple Logger that does the same thing with
 * messages regardless of the error level has to implement.
 */
abstract class AbstractLogger implements LoggerInterface
{
    use LoggerTrait;

    public function log($level, $message, array $context = []):void
    {
        $this->log($level, $message, $context);}
}

$whoops = new \Whoops\Run();
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler());

    // Set Whoops as the default error and exception handler used by PHP:
    $whoops->register();

    throw new \RuntimeException("Oopsie!");