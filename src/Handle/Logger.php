<?php

namespace YukataRm\Laravel\Exception\Handle;

use YukataRm\Laravel\Exception\Trait\Exception;
use YukataRm\Laravel\Exception\Trait\Config;

use YukataRm\Laravel\Logger\Facade\Logger as LoggerFacade;
use YukataRm\Laravel\Logger\Logger as LaravelLogger;
use YukataRm\Logger\Enum\LogFormatEnum;

/**
 * Exception Logger
 * 
 * @package YukataRm\Laravel\Exception\Handle
 */
class Logger
{
    use Exception;
    use Config {
        config as parentConfig;
    }

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
    }

    /*----------------------------------------*
     * Method
     *----------------------------------------*/

    /**
     * logging
     * 
     * @param string $message
     * @return void
     */
    protected function logging(): void
    {
        $logger = $this->logger();

        $logger->add($this->contents());

        $logger->logging();
    }

    /**
     * get logger instance
     * 
     * @return \YukataRm\Laravel\Logger\Logger
     */
    protected function logger(): LaravelLogger
    {
        $logger = LoggerFacade::alert();

        $logger->setBaseDirectory($this->configBaseDirectory());

        $logger->setDirectory($this->configDirectory());

        $logger->setFileNameFormat($this->configFileNameFormat());

        $logger->setFileExtension($this->configFileExtension());

        $logger->setFileMode($this->configFileMode());

        if (!is_null($this->configFileOwner())) $logger->setFileOwner($this->configFileOwner());

        if (!is_null($this->configFileGroup())) $logger->setFileGroup($this->configFileGroup());

        $logger->setLogFormat(LogFormatEnum::MESSAGE);

        return $logger;
    }

    /*----------------------------------------*
     * Config
     *----------------------------------------*/

    /**
     * get config or default
     * 
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    protected function config(string $key, mixed $default): mixed
    {
        return $this->parentConfig("logging.{$key}", $default);
    }

    /**
     * get config base directory
     * 
     * @return string
     */
    protected function configBaseDirectory(): string
    {
        return $this->config("base_directory", storage_path("logs"));
    }

    /**
     * get config directory
     * 
     * @return string
     */
    protected function configDirectory(): string
    {
        return $this->config("directory", "exception");
    }

    /**
     * get config file name format
     * 
     * @return string
     */
    protected function configFileNameFormat(): string
    {
        return $this->config("file.name_format", "Y-m-d");
    }

    /**
     * get config file extension
     * 
     * @return string
     */
    protected function configFileExtension(): string
    {
        return $this->config("file.extension", "log");
    }

    /**
     * get config file mode
     * 
     * @return int
     */
    protected function configFileMode(): int
    {
        return $this->config("file.mode", 0666);
    }

    /**
     * get config file owner
     * 
     * @return string|null
     */
    protected function configFileOwner(): string|null
    {
        return $this->config("file.owner", null);
    }

    /**
     * get config file group
     * 
     * @return string|null
     */
    protected function configFileGroup(): string|null
    {
        return $this->config("file.group", null);
    }
}
