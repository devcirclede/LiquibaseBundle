<?php

declare(strict_types=1);

namespace Freesoftde\LiquibaseBundle\Command;

use Freesoftde\Validator\JavaValidator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class LiquibaseInitCommand extends Command
{

    protected static $defaultName = 'liquibase:init';

    protected function configure()
    {
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        if (!JavaValidator::validate()) {
            $output->write('Java was not found.');
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
