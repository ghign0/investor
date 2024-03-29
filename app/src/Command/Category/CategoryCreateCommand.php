<?php

namespace App\Command\Category;

use App\Handler\Category\CategoryCreateHandler;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

#[AsCommand(
    name: 'app:category:create',
    description: 'crea una nuova categoria'
)]
class CategoryCreateCommand extends Command
{
    public function __construct(
        private CategoryCreateHandler $handler
    )
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("CATEGORIA - crea");
        $output->writeln("------------------");

        $helper = $this->getHelper('question');
        $questionName = new Question("Inseirsci la nuova categoria: \n> ", '');
        $name = $helper->ask($input,$output, $questionName);

        $category = $this->handler->handle($name);

        return Command::SUCCESS;

    }

}