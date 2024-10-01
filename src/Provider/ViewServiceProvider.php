<?php

namespace YukataRm\Laravel\Exception\Provider;

use YukataRm\Laravel\Provider\ViewServiceProvider as BaseServiceProvider;

/**
 * View Service Provider
 * 
 * @package YukataRm\Laravel\Exception\Provider
 */
class ViewServiceProvider extends BaseServiceProvider
{
    /**
     * base path
     * 
     * @var string
     */
    protected string $basePath = __DIR__;

    /**
     * get views
     * 
     * @return array<string, string>
     */
    protected function views(): array
    {
        return [
            "views" => "YR::Exception"
        ];
    }
}
