<?php

namespace App\Command\Asset;

use App\Model\Category;
use App\Repository\CategoryRepository;
use App\Repository\RiskRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\Question;

class AssetCreateCommand extends Command
{
    public function __construct(
        private CategoryRepository $categoryRepository,
        private RiskRepository $riskRepository,
    )
    {
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('app:asset:create')
            ->setDescription('crea un nuovo conto');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {

            $helper = $this->getHelper('question');
            $output->write("Asset - crea un nuovo conto");

            $questionName = new Question("Inserisi il nome del nuovo conto: ", '');
            $name = $helper->ask($input, $output, $questionName);

            $questionParent = new Question("Inserisci il nome del parent: ", '');
            $parent = $helper->ask($input, $output, $questionParent);

            $categories =  $this->categoryRepository->findAll();
            /** @var Category $category */
            foreach ($categories as $category) {
                $categoriesChoice[] =  $category->getName();
            }
            $questionCatogory = new ChoiceQuestion("Scegli la cateogira", $categoriesChoice );
            $category = $helper->ask($input, $output, $questionCatogory);
            $output->writeln("hai sccelto : ".$category);
        }
        catch (\Exception $e) {
            $output->writeln($e->getTraceAsString());
            return Command::FAILURE;
        }



        return Command::SUCCESS;
    }


}