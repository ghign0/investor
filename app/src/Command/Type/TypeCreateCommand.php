<?php

namespace App\Command\Type;

use App\Handler\Type\TypeCreateHandler;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class TypeCreateCommand extends Command
{
    public function __construct(
        private TypeCreateHandler $handler
    )
    {
        parent::__construct();
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $output->writeln("TIPOLOGIA - crea");
        $output->writeln("------------------");

        $helper = $this->getHelper('question');
        $questionName = new Question("Inseirsci la nuova tipologia di asset: \n> ", '');
        $name = $helper->ask($input,$output, $questionName);

        $type = $this->handler->handle($name);

        return Command::SUCCESS;
    }
}