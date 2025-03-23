<?php

namespace YukataRm\Laravel\Exception\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Exception Facade
 *
 * @package YukataRm\Laravel\Exception\Facades
 *
 * @method static \YukataRm\Laravel\Exception\Interfaces\HandlerInterface handler()
 *
 * @method static void handle(\Throwable $exception)
 *
 * @see \YukataRm\Laravel\Exception\Facades\Manager
 */
class Exception extends Facade
{
    /**
     * Facade Accessor
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return static::class;
    }
}
