<?php

namespace App\Command\Asset;

use App\Handler\Asset\AssetListHandler;
use App\Model\ValueObject\Asset;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:asset:list',
    description: 'visualizza la lista di tutti gli asset'
)]
class AssetListCommand extends  Command
{

    public function __construct(
        private AssetListHandler $handler
    )
    {
        parent::__construct();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $table = new Table($output);
        $table->setHeaderTitle("ASSET registrati");
        $table->setHeaders(['ID', 'Nome', 'Parent', 'Categoria', 'Tipo', 'Rischio', 'Capitale immesso', 'Revenue']);

        $assets = $this->handler->handle();

        /** @var Asset $asset */
        foreach ($assets as $asset) {
            $table->addRow([
                $asset->getId()->toRfc4122(),
                $asset->getName(),
                $asset->getParent(),
                $asset->getCategory()->getName(),
                $asset->getType()->getName(),
                $asset->getRisk()->getName(),
                $asset->getWallet()?->getCapital(),
                $asset->getWallet()?->getRevenue(),
            ]);
        }

        $table->render();

        return Command::SUCCESS;
    }

}