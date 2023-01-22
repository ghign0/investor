<?php

namespace App\Command\Category;

use App\Handler\Category\CategoryCreateHandler;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CategoryCreateCommand extends Command
{
    public function __construct(
        private CategoryCreateHandler $handler
    )
    {
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('app:category:create')
            ->setDescription("crea una nuova categoria");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("CATEGORIA - crea");
        $output->writeln("------------------");

        $category = $this->handler->handle('');

        return Command::SUCCESS;

    }

}