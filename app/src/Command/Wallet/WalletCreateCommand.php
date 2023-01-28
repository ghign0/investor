<?php

namespace App\Command\Wallet;


use App\Handler\Asset\AssetListHandler;
use App\Handler\Wallet\WalletCreateHandler;
use App\Model\ValueObject\Asset;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Uid\Uuid;

#[AsCommand(
    name: 'app:wallet:create',
    description: 'crea una wallet e lo collega a un asset'
)]
class WalletCreateCommand extends Command
{
    public function __construct(
        private AssetListHandler $assetListHandler,
        private WalletCreateHandler $handler
    )
    {
        parent::__construct();
    }

    protected function configure()
    {
        $this->addOption('empty', 'm', InputOption::VALUE_NONE, 'opzione se si vuole inizlizare vuoto ')
            ->addOption('asset', 'a' ,InputOption::VALUE_NONE , 'ID dell\' asset a cui collegare il wallet')
            ->setHelp("crea un wallet e lo collega a un asset.");
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln("Wallet - Crea");
        $output->writeln("-------------");


        $assetId = $this->getAssetId($input, $output);
        $walletData = $this->getWalletData( $input, $output) ;

        $wallet = $this->handler->handle($assetId, $walletData);

        return Command::SUCCESS;


    }


    private function getWalletData( InputInterface $input, OutputInterface $output):array
    {
        $empty = $input->getOption('empty');
        $walletData =  [];
        if (!$empty) {
            $helper = $this->getHelper('question');
            $capitalQuestion = new Question("Indica il Capitale Immesso nel wallet \n> ", '');
            $walletData['capital'] =  $helper->ask($input, $output, $capitalQuestion);


            $revenureQuestion = new Question("Indica il valore totale del Wallet \n> ", '');
            $walletData['revenue'] =  $helper->ask($input, $output, $revenureQuestion);
        }
        return $walletData;
    }

    private function getAssetId (InputInterface $input, OutputInterface $output): Uuid
    {
        $assetId =  $input->getOption('asset');
        if (!$assetId) {
            $assets = $this->assetListHandler->handle();
            $table = new Table($output);
            $table->setHeaderTitle("ASSET DISPONIBILI");
            $table->setHeaders(['ID', 'Nome']);
            /** @var Asset $asset */
            foreach ($assets as $asset) {
                $table->addRow([$asset->getId()->toRfc4122(), $asset->getName()]);
            }

            $table->render();

            $helper = $this->getHelper('question');
            $quesionAsset = new Question("Inserisci ID asset di cui vuoi creare il wallet\n> ", '');
            $assetId =  $helper->ask($input, $output, $quesionAsset);
        }
        return Uuid::fromRfc4122($assetId);

    }
}