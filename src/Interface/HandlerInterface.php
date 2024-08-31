<?php

namespace YukataRm\Laravel\Exception\Interface;

/**
 * Handler Interface
 * 
 * @package YukataRm\Laravel\Exception\Interface
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
