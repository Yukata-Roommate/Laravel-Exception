<?php

namespace YukataRm\Laravel\Exception\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * Handler Facade
 * 
 * @package YukataRm\Laravel\Exception\Facade
 * 
 * @method static \YukataRm\Laravel\Exception\Interface\HandlerInterface make()
 * 
 * @method static void handle(\Throwable $exception)
 * 
 * @see \YukataRm\Laravel\Exception\Facade\Manager
 */
class Handler extends Facade
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
