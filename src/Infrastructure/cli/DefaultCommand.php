<?php
declare(strict_types=1);

namespace Php8SkeletonHexArchitecture\Infrastructure\cli;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DefaultCommand extends BaseCommand
{
    /**
     * @return void
     */
    public function configure(): void
    {
        $this->setName(
            name: 'default:example'
        );
        $this->setDescription(
            description: 'This command has been created as an example!!'
        );
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln(
            messages: '<fg=yellow>Hellow!!</>'
        );
        return 0;
    }
}