<?php

namespace YukataRm\Laravel\Exception\Interfaces;

/**
 * Handler Interface
 *
 * @package YukataRm\Laravel\Exception\Interfaces
 */
interface HandlerInterface
{
    /**
     * handle exception
     *
     * @param \Throwable $exception
     * @return void
     */
    public function handle(\Throwable $exception): void;
}
