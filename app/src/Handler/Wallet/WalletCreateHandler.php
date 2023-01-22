<?php

namespace App\Handler\Wallet;

use App\Model\Asset;
use App\Model\Wallet;
use Doctrine\ORM\EntityManagerInterface;

class WalletCreateHandler
{
    public function __construct(
        private EntityManagerInterface $entityManager
    )
    {
    }

    public function handle(?Asset $asset = null)
    {
        $wallet = new Wallet();
        $wallet->createEmptyWallet();

        if (!is_null($asset)) {
            $wallet->setAsset($asset);
        }
        $this->entityManager->persist($wallet);
        $this->entityManager->flush();

    }

}