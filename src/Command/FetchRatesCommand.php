<?php
// src/Command/FetchRatesCommand.php
namespace App\Command;

use App\Task\FetchRatesTask;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FetchRatesCommand extends Command
{
    protected static $defaultName = 'app:fetch-rates';

    public function __construct(private FetchRatesTask $task)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        ($this->task)(); // викликаємо __invoke()
        $output->writeln('✅ Rates fetched');
        return Command::SUCCESS;
    }
}
