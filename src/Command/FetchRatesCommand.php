<?php

namespace App\Command;

use App\Task\FetchRatesTask;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:fetch-rates')]
class FetchRatesCommand extends Command
{

    public function __construct(private readonly FetchRatesTask $task)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        ($this->task)();
        $output->writeln('Rates fetched');
        return Command::SUCCESS;
    }
}
