<?php
declare(strict_types=1);

namespace Php8SkeletonHexArchitecture\Infrastructure\CLI;


use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Command\Command;

class BaseCommand extends Command
{
    /**
     * BaseCommand constructor.
     * @param ContainerInterface $container
     */
    public function __construct(
        protected ContainerInterface $container
    )
    {
        parent::__construct();
    }
}