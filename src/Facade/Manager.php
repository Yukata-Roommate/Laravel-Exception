<?php

namespace YukataRm\Laravel\Exception\Facade;

use YukataRm\Laravel\Exception\Interface\HandlerInterface;

use YukataRm\Laravel\Exception\Handler;

/**
 * Facade Manager
 * 
 * @package YukataRm\Laravel\Exception\Facade
 */
class Manager
{
    /**
     * make Handler instance
     * 
     * @return \YukataRm\Laravel\Exception\Interface\HandlerInterface
     */
    public function make(): HandlerInterface
    {
        return new Handler();
    }

    /**
     * handle exception
     * 
     * @param \Throwable $exception
     * @return void
     */
    public function handle(\Throwable $exception): void
    {
        $this->make()->handle($exception);
    }
}
