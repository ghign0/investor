<?php

namespace App\Command;

use App\Handler\Category\CategoryListHandler;
use App\Model\Category;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CategoryListCommand extends Command
{
    public function __construct(
        private CategoryListHandler $handler
    )
    {
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('app:category:list')
            ->setDescription('visluazza tutte le categorie');
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

        $categories = $this->handler->handle(new \App\Handler\Category\CategoryListCommand());

        /** @var Category $category */
        foreach ( $categories as $category) {
            $output->writeln(sprintf("> %s -  %s [%s]", $category->getId()->toRfc4122(),  $category->getName(), $category->getCode()));
        }

        return Command::SUCCESS;
    }

}