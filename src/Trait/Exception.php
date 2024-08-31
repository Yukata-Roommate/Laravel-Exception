<?php

namespace YukataRm\Laravel\Exception\Trait;

/**
 * Exception trait
 * 
 * @package YukataRm\Laravel\Exception\Trait
 */
trait Exception
{
    /**
     * exception
     * 
     * @var \Throwable
     */
    protected \Throwable $exception;

    /**
     * set exception
     * 
     * @param \Throwable $exception
     * @return void
     */
    protected function setException(\Throwable $exception): void
    {
        $this->exception = $exception;
    }

    /**
     * get exception
     * 
     * @return \Throwable
     */
    protected function exception(): \Throwable
    {
        return $this->exception;
    }

    /**
     * get exception contents
     * 
     * @return array<string, mixed>
     */
    protected function contents(): array
    {
        return [
            "datetime"  => date("Y-m-d H:i:s"),
            "className" => get_class($this->exception()),
            "url"       => request()->fullUrl(),
            "message"   => $this->exception()->getMessage(),
            "code"      => $this->exception()->getCode(),
            "file"      => $this->exception()->getFile(),
            "line"      => $this->exception()->getLine(),
            "traces"    => explode(PHP_EOL, $this->exception()->getTraceAsString()),
        ];
    }
}
