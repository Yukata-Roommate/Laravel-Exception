<?php

namespace YukataRm\Laravel\Exception\Handle;

use YukataRm\Laravel\Exception\Trait\Exception;
use YukataRm\Laravel\Exception\Trait\Config;

use YukataRm\Laravel\Mail\Client;

use YukataRm\Laravel\Logger\Facade\Logger;

/**
 * Exception Mailer
 * 
 * @package YukataRm\Laravel\Exception\Handle
 */
class Mailer
{
    use Exception {
        contents as parentContents;
    }
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

        $this->mailing();
    }

    /*----------------------------------------*
     * Method
     *----------------------------------------*/

    /**
     * mailing
     * 
     * @return void
     */
    protected function mailing(): void
    {
        if (!$this->isSendable()) return;

        $recipients = $this->configTo();

        foreach ($recipients as $recipientName => $recipientAddress) {
            $this->client($recipientAddress, $recipientName)->send();
        }

        return;
    }

    /**
     * whether sendable
     * 
     * @return bool
     */
    protected function isSendable(): bool
    {
        if (empty($this->view())) return $this->parameterEmptyLog("view");

        if (empty($this->configFromAddress())) return $this->parameterEmptyLog("from address");

        if (empty($this->configFromName())) return $this->parameterEmptyLog("from name");

        if (empty($this->configSubject())) return $this->parameterEmptyLog("subject");

        if (empty($this->configTo())) return $this->parameterEmptyLog("to");

        return true;
    }

    /**
     * get Client instance
     * 
     * @param string $address
     * @param string|null $name
     * @return \YukataRm\Laravel\Mail\Client
     */
    protected function client(string $address, string|null $name = null): Client
    {
        $client = new Client();

        $client->setView($this->view());

        $client->setWith($this->contents());

        $client->setSubject($this->configSubject());

        $client->setSenderAddress($this->configFromAddress());

        $client->setSenderName($this->configFromName());

        $client->setRecipientAddress($address);

        if (!is_null($name)) $client->setRecipientName($name);

        return $client;
    }

    /**
     * view string
     * 
     * @return string
     */
    protected function view(): string
    {
        return "YR::Exception::email";
    }

    /**
     * run parameter empty log
     * 
     * @param string $parameter
     * @return false
     */
    protected function parameterEmptyLog(string $parameter): false
    {
        $this->logging("{$parameter} is empty.");

        return false;
    }

    /**
     * logging
     * 
     * @param string $message
     * @return void
     */
    protected function logging(string $message): void
    {
        Logger::alertLog($message);
    }

    /*----------------------------------------*
     * Exception
     *----------------------------------------*/

    /**
     * get exception contents
     * 
     * @return array<string, mixed>
     */
    protected function contents(): array
    {
        return array_merge($this->parentContents(), [
            "subject" => $this->configSubject(),
        ]);
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
        return $this->parentConfig("mailing.{$key}", $default);
    }

    /**
     * get config subject
     * 
     * @return string
     */
    protected function configSubject(): string
    {
        return $this->config("subject", "Exception Occurred");
    }

    /**
     * get config from address
     * 
     * @return string|null
     */
    protected function configFromAddress(): string|null
    {
        return $this->config("from.address", null);
    }

    /**
     * get config from name
     * 
     * @return string|null
     */
    protected function configFromName(): string|null
    {
        return $this->config("from.name", null);
    }

    /**
     * get config to
     * 
     * @return array
     */
    protected function configTo(): array
    {
        return $this->config("to", []);
    }
}
