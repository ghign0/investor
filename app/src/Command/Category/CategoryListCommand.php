<?php

namespace App\Command\Category;

use App\Handler\Category\CategoryListHandler;
use App\Model\Category;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
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
        $categories = $this->handler->handle();

        $table = new Table($output);
        $table->setHeaderTitle("Lista delle Categorie");
        $table->setHeaders(['id', 'Name', 'code']);

        /** @var Category $category */
        foreach ( $categories as $category) {
            $table->addRow([$category->getId()->toRfc4122(),  $category->getName(), $category->getCode()]);
        }

        $table->render();
        return Command::SUCCESS;
    }

}