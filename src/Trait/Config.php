<?php

namespace YukataRm\Laravel\Exception\Trait;

/**
 * Config trait
 * 
 * @package YukataRm\Laravel\Exception\Trait
 */
trait Config
{
    /**
     * get config or default
     * 
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    protected function config(string $key, mixed $default): mixed
    {
        return config("yukata-roommate.exception.{$key}", $default);
    }
}
