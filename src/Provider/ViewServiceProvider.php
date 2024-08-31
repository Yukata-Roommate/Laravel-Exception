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
     * get path and namespace pairs
     * 
     * @return array<string, string>
     */
    protected function pairs(): array
    {
        return [
            "views" => "YR::Exception"
        ];
    }
}
