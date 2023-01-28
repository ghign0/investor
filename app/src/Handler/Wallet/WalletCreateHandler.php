<?php

namespace App\Handler\Wallet;

use App\Model\ValueObject\Asset;
use App\Model\Wallet;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Uid\Uuid;

class WalletCreateHandler
{
    public function __construct(
        private EntityManagerInterface $entityManager
    )
    {
    }

    public function handle(Uuid $assetId, array $walletData)
    {
        $wallet = new Wallet();
        $wallet->createEmptyWallet();

        if(array_key_exists('capital', $walletData))  {
            $capital = floatval($walletData['capital']);
            $wallet->setCapital($capital);
        }
        if(array_key_exists('revenue', $walletData))  {
            $revenue = floatval($walletData['revenue']);
            $wallet->setRevenue($revenue);
        }

        $assetRepository = $this->entityManager->getRepository(Asset::class);
        /** @var Asset $asset */
        $asset = $assetRepository->find($assetId);
        if ($asset->hasWallet()) {
            throw  new \Exception("l'asset ha già un wallet collegato. non si può sovrascirvere");
        }
        $asset->setWallet($wallet);


        $this->entityManager->persist($wallet);
        $this->entityManager->persist($asset);
        $this->entityManager->flush();

        return $wallet;

    }

}