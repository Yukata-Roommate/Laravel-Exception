<?php

namespace YukataRm\Laravel\Exception\Commands;

use YukataRm\Laravel\Command\PublishStubsCommand as BaseCommand;

/**
 * Publish Stubs Command
 *
 * @package YukataRm\Laravel\Exception\Commands
 */
class PublishStubsCommand extends BaseCommand
{
    /**
     * command signature
     *
     * @var string
     */
    protected $signature = "exception:publish";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Publish exception resources";

    /*----------------------------------------*
     * Parameter
     *----------------------------------------*/

    /**
     * set parameter
     *
     * @return void
     */
    protected function setParameter(): void {}

    /*----------------------------------------*
     * Process
     *----------------------------------------*/

    /**
     * assets name
     *
     * @var string
     */
    protected string $assetsName = "exception";

    /**
     * stubs directory path
     *
     * @var string
     */
    protected string $stubsDirectory = __DIR__ . "/../../stubs";
}
