<?php

namespace App\Command\Risk;

use App\Handler\Risk\RiskCreateHandler;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

#[AsCommand(
    name: 'app:risk:create',
    description: 'aggiungi un nuovo livello di rischio'
)]
class RiskCreateCommand extends Command
{

    public function __construct(
        private RiskCreateHandler $handler,
    )
    {
        parent::__construct();
    }

    protected function configure()
    {

    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("RISCHIO - crea");
        $output->writeln("------------------");

        $helper = $this->getHelper('question');
        $questionName = new Question("Inseirsci il nuovo livello di rischio: \n> ", '');
        $name = $helper->ask($input,$output, $questionName);

        $risk = $this->handler->handle($name);

        return Command::SUCCESS;
    }
}