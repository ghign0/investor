<?php

namespace App\Command\Asset;

use App\Handler\Asset\AssetCreateHandler;
use App\Model\ValueObject\Asset;
use App\Model\Category;
use App\Model\Risk;
use App\Model\Type;
use App\Repository\CategoryRepository;
use App\Repository\RiskRepository;
use App\Repository\TypeRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\Question;

#[AsCommand(
    name: 'app:asset:create',
    description: 'crea un nuovo conto'
)]
class AssetCreateCommand extends Command
{
    public function __construct(
        private CategoryRepository $categoryRepository,
        private RiskRepository $riskRepository,
        private TypeRepository $typeRepository,
        private AssetCreateHandler $handler
    )
    {
        parent::__construct();
    }

    protected function configure()
    {
        $this->setHelp('Questo comando serve a creare un nuovo conto, tramite un wizard. Non verrà chiesto alcun dato economico');
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
            $output->writeln("Asset - crea un nuovo conto");
            $output->writeln("----------------------------");

            $questionName = new Question("Inserisi il nome del nuovo conto: ", '');
            $nameChosen = $helper->ask($input, $output, $questionName);

            $questionParent = new Question("Inserisci il nome del parent: ", '');
            $parentChosen = $helper->ask($input, $output, $questionParent);

            $categories =  $this->categoryRepository->findAll();
            foreach ($categories as $category) {
                $categoriesChoice[$category->getCode()] = $category->getName();  ;
            }
            $questionCatogory = new ChoiceQuestion("Scegli la cateogira", $categoriesChoice );
            $categoryChosen = $helper->ask($input, $output, $questionCatogory);

            $types = $this->typeRepository->findAll();
            foreach ($types as $type) {
                $typeChoices[$type->getCode()] = $type->getName();
            }
            $questionType = new ChoiceQuestion("Scegli il livello di rischio", $typeChoices);
            $typeChosen = $helper->ask($input, $output, $questionType);


            $risks = $this->riskRepository->findAll();
            foreach ($risks as $risk) {
                $risksChoices[$risk->getCode()] = $risk->getName();
            }
            $questionRisk = new ChoiceQuestion("Scegli il livello di rischio", $risksChoices);
            $riskChsone = $helper->ask($input, $output, $questionRisk);


            $category = array_filter($categories, function(Category $category) use ($categoryChosen){
                return $category->getCode() === $categoryChosen;
            } );
            $category = reset($category);

            $type = array_filter($types, function(Type $type) use ($typeChosen){
                return $type->getCode() === $typeChosen;
            } );
            $type = reset($type);
            $risk = array_filter($risks, function(Risk $risk) use ($riskChsone){
                return $risk->getCode() === $riskChsone;
            } );
            $risk = reset($risk);


            $newAsset = $this->handler->handle($nameChosen, $parentChosen, $category, $type, $risk);

            $output->writeln("Hai creato il conto: ");
            $output->writeln(sprintf("%s (famiglia di %s) ", $newAsset->getName(), $newAsset->getParent()));
            $output->writeln(sprintf("categoria:  %s  tipologia : %s", $newAsset->getCategory()->getName(), $newAsset->getType()->getName()));

            $output->writeln(sprintf("livello di rischio :  %s", $newAsset->getRisk()->getName()));


            return Command::SUCCESS;
        }
        catch (\Exception $e) {
            $output->writeln($e->getMessage());
            $output->writeln($e->getTraceAsString());
            return Command::FAILURE;
        }

    }


}