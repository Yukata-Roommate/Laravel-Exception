<?php

namespace YukataRm\Laravel\Exception;

use YukataRm\Laravel\Exception\Interface\HandlerInterface;

use YukataRm\Laravel\Exception\Trait\Exception;
use YukataRm\Laravel\Exception\Trait\Config;

use YukataRm\Laravel\Exception\Handle\Logger;
use YukataRm\Laravel\Exception\Handle\Mailer;

/**
 * Exception Handler
 * 
 * @package YukataRm\Laravel\Exception
 */
class Handler implements HandlerInterface
{
    use Exception;
    use Config;

    /*----------------------------------------*
     * Handle
     *----------------------------------------*/

    /**
     * handle exception
     * 
     * @param \Throwable $exception
     * @return void
     */
    public function handle(\Throwable $exception): void
    {
        $this->setException($exception);

        $this->logging();

        $this->mailing();
    }

    /*----------------------------------------*
     * Logger
     *----------------------------------------*/

    /**
     * whether enable logging
     * 
     * @return bool
     */
    protected function enableLogging(): bool
    {
        return $this->configEnableLogging();
    }

    /**
     * logging
     * 
     * @return void
     */
    protected function logging(): void
    {
        if (!$this->enableLogging()) return;

        $logger = new Logger();

        $logger->handle($this->exception());
    }

    /*----------------------------------------*
     * Mailer
     *----------------------------------------*/

    /**
     * whether enable mailing
     * 
     * @return bool
     */
    protected function enableMailing(): bool
    {
        return $this->configEnableMailing();
    }

    /**
     * mailing
     * 
     * @return void
     */
    protected function mailing(): void
    {
        if (!$this->enableMailing()) return;

        $mailer = new Mailer();

        $mailer->handle($this->exception());
    }

    /*----------------------------------------*
     * Config
     *----------------------------------------*/

    /**
     * get config enable logging
     * 
     * @return bool
     */
    protected function configEnableLogging(): bool
    {
        return $this->config("enable.logging", false);
    }

    /**
     * get config enable mailing
     * 
     * @return bool
     */
    protected function configEnableMailing(): bool
    {
        return $this->config("enable.mailing", false);
    }
}
