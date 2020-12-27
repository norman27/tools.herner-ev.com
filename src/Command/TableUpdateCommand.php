<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TableUpdateCommand extends Command
{
    protected static $defaultName = 'cronjob:table-update';

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setDescription('Update league table data')
            ->setHelp(<<<'EOF'
The <info>%command.name%</info> updates the league tables based on their configured source.
EOF
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $output->write('running...');
            return Command::SUCCESS;
        } catch (\Exception $exception) {
            return Command::FAILURE;
        }
    }
}
