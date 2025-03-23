<?php

namespace YukataRm\Laravel\Exception\Facades;

use YukataRm\Laravel\Exception\Interfaces\HandlerInterface;

use YukataRm\Laravel\Exception\Handler;

/**
 * Exception Facade Manager
 *
 * @package YukataRm\Laravel\Exception\Facades
 */
class Manager
{
    /**
     * make Handler instance
     *
     * @return \YukataRm\Laravel\Exception\Interfaces\HandlerInterface
     */
    public function handler(): HandlerInterface
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
        $this->handler()->handle($exception);
    }
}
