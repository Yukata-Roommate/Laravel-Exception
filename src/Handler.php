<?php

namespace YukataRm\Laravel\Exception;

use YukataRm\Laravel\Exception\Interfaces\HandlerInterface;

use YukataRm\Laravel\Log\Facades\Log;
use YukataRm\Laravel\Log\Logger;
use YukataRm\Log\Enums\LogFormatEnum;

use YukataRm\Laravel\Mail\Client;

/**
 * Exception Handler
 *
 * @package YukataRm\Laravel\Exception
 */
class Handler implements HandlerInterface
{
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
     * Exception
     *----------------------------------------*/

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
            "subject"   => $this->subject(),
            "datetime"  => date("Y-m-d H:i:s"),
            "className" => get_class($this->exception()),
            "url"       => request()->fullUrl(),
            "exception" => $this->exception()->getMessage(),
            "code"      => $this->exception()->getCode(),
            "file"      => $this->exception()->getFile(),
            "line"      => $this->exception()->getLine(),
            "traces"    => explode(PHP_EOL, $this->exception()->getTraceAsString()),
        ];
    }

    /*----------------------------------------*
     * Logger
     *----------------------------------------*/

    /**
     * logging
     *
     * @return void
     */
    protected function logging(): void
    {
        if (!$this->enableLogging()) return;

        $logger = $this->logger();

        $logger->add($this->contents());

        $logger->logging();
    }

    /**
     * whether enable logging
     *
     * @return bool
     */
    protected function enableLogging(): bool
    {
        return config("yr-exception.enable.logging", false);
    }

    /**
     * get logger instance
     *
     * @return \YukataRm\Laravel\Log\Logger
     */
    protected function logger(): Logger
    {
        $logger = Log::make()->alert();

        $logger->setBaseDirectory($this->logBaseDirectory());

        $logger->setDirectory($this->logDirectory());

        $logger->setFileNameFormat($this->logFileNameFormat());

        $logger->setFileExtension($this->logFileExtension());

        $logger->setLogFormat(LogFormatEnum::MESSAGE);

        return $logger;
    }

    /**
     * get log base directory
     *
     * @return string
     */
    protected function logBaseDirectory(): string
    {
        return storage_path("logs");
    }

    /**
     * get log directory
     *
     * @return string
     */
    protected function logDirectory(): string
    {
        return "exception";
    }

    /**
     * get log file name format
     *
     * @return string
     */
    protected function logFileNameFormat(): string
    {
        return "Y-m-d";
    }

    /**
     * get log file extension
     *
     * @return string
     */
    protected function logFileExtension(): string
    {
        return "log";
    }

    /*----------------------------------------*
     * Mailer
     *----------------------------------------*/

    /**
     * mailing
     *
     * @return void
     */
    protected function mailing(): void
    {
        if (!$this->enableMailing()) return;

        if (!$this->isSendable()) return;

        $recipients = $this->to();

        foreach ($recipients as $recipientName => $recipientAddress) {
            if (empty($recipientAddress)) continue;

            $this->client($recipientAddress, $recipientName)->send();
        }
    }

    /**
     * whether enable mailing
     *
     * @return bool
     */
    protected function enableMailing(): bool
    {
        return config("yr-exception.enable.mailing", false);
    }

    /**
     * whether sendable
     *
     * @return bool
     */
    protected function isSendable(): bool
    {
        if (empty($this->view())) return $this->parameterEmptyLog("view");

        if (empty($this->fromAddress())) return $this->parameterEmptyLog("from address");

        if (empty($this->fromName())) return $this->parameterEmptyLog("from name");

        if (empty($this->subject())) return $this->parameterEmptyLog("subject");

        return true;
    }

    /**
     * get Client instance
     *
     * @param string $address
     * @param string|int $name
     * @return \YukataRm\Laravel\Mail\Client
     */
    protected function client(string $address, string|int $name): Client
    {
        $client = new Client();

        $client->setView($this->view());

        $client->setWith($this->with());

        $client->setSubject($this->subject());

        $client->setSenderAddress($this->fromAddress());

        $client->setSenderName($this->fromName());

        $client->setRecipientAddress($address);

        if (is_string($name) && !empty($name)) $client->setRecipientName($name);

        return $client;
    }

    /**
     * view string
     *
     * @return string
     */
    protected function view(): string
    {
        return "email.exception";
    }

    /**
     * with contents
     *
     * @return array<string, mixed>
     */
    protected function with(): array
    {
        return $this->contents();
    }

    /**
     * run parameter empty log
     *
     * @param string $parameter
     * @return false
     */
    protected function parameterEmptyLog(string $parameter): false
    {
        Log::alert("{$parameter} is empty.");

        return false;
    }

    /**
     * get subject
     *
     * @return string
     */
    protected function subject(): string
    {
        return config("yr-exception.mailing.subject", "Exception Occurred");
    }

    /**
     * get from address
     *
     * @return string|null
     */
    protected function fromAddress(): string|null
    {
        return config("yr-exception.mailing.from.address", null);
    }

    /**
     * get from name
     *
     * @return string|null
     */
    protected function fromName(): string|null
    {
        return config("yr-exception.mailing.from.name", null);
    }

    /**
     * get to
     *
     * @return array
     */
    protected function to(): array
    {
        return config("yr-exception.mailing.to", []);
    }
}
