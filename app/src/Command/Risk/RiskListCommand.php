<?php

namespace App\Command\Risk;

use App\Handler\Risk\RiskListHandler;
use App\Model\Risk;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:risk:list',
    description: 'visluazza tutte le tipologie di rischio'
)]
class RiskListCommand extends Command
{
    public function __construct(
        private RiskListHandler $handler
    )
    {
        parent::__construct();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $risks = $this->handler->handle();

        $table = new Table($output);
        $table->setHeaderTitle("Lista dei livelli di rischio");
        $table->setHeaders(['id', 'Name', 'code']);

        /** @var Risk $risk */
        foreach ($risks as $risk) {
            $table->addRow([$risk->getId()->toRfc4122(), $risk->getName(), $risk->getCode()]);

        }

        $table->render();

        return Command::SUCCESS;
    }
}