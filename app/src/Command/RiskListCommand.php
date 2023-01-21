<?php

namespace App\Command;

use App\Handler\Risk\RiskListHandler;
use App\Model\Risk;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RiskListCommand extends Command
{
    public function __construct(
        private RiskListHandler $handler
    )
    {
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('app:risk:list')
            ->setDescription('visluazza tutte le tipologie di rischio');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("CATEGORIA - vedi lista");
        $output->writeln("------------------");

        $risks = $this->handler->handle();

        /** @var Risk $risk */
        foreach ($risks as $risk) {
            $output->writeln(sprintf("> %s -  %s [%s]", $risk->getId()->toRfc4122(), $risk->getName(), $risk->getCode()));
        }

        return Command::SUCCESS;
    }
}