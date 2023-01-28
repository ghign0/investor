<?php

namespace App\Command\Wallet;

use App\Handler\Asset\AssetListHandler;
use App\Handler\Wallet\WalletCreateHandler;
use App\Model\Asset;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

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
        $this->addOption('empty', 'e', InputOption::VALUE_OPTIONAL)
            ->addArgument('asset', 'a', InputArgument::OPTIONAL)
            ->setHelp("crea un wallet e lo collega a un asset.");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("Wallet - Crea");
        $output->writeln("-------------");

        $empty = $input->getOption('empty') ?? false;
        $assetId = $input->getArgument('asset') ?? false;

        if (is_null($assetId)) {
            $assets = $this->assetListHandler->handle();
            $table = new Table($output);
            $table->setHeaderTitle("ASSET DISPONIBILI");
            $table->addRows(['ID', 'Nome']);
            /** @var Asset $asset */
            foreach ($assets as $asset) {
                $table->addRow([$asset->getId()->toRfc4122(), $asset->getName()]);
            }
        }



        $wallet = $this->handler->handle();


    }
}