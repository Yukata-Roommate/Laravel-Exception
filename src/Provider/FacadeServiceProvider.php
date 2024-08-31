<?php

namespace YukataRm\Laravel\Exception\Provider;

use YukataRm\Laravel\Provider\FacadeServiceProvider as BaseServiceProvider;

use YukataRm\Laravel\Exception\Facade\Manager;
use YukataRm\Laravel\Exception\Facade\Handler;

/**
 * Facade Service Provider
 * 
 * @package YukataRm\Laravel\Exception\Provider
 */
class FacadeServiceProvider extends BaseServiceProvider
{
    /**
     * get facades
     * 
     * @return array<string, string>
     */
    protected function facades(): array
    {
        return [
            Handler::class => Manager::class
        ];
    }
}
