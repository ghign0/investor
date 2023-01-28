<?php

namespace App\Model;


use App\Model\ValueObject\Asset;
use App\Repository\WalletRepository;
use Doctrine\DBAL\Types\Types;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WalletRepository::class)]
class Wallet
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator' )]
    #[ORM\Column( type: UuidType::NAME, unique: true)]
    private Uuid $id;

    #[ORM\OneToOne(mappedBy: 'wallet', targetEntity: Asset::class)]
    private Asset $asset;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private float  $capital;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private float $revenue;


    public function createEmptyWallet()
    {
        $this->capital = 0;
        $this->revenue = 0;
    }

    /**
     * @param Asset $asset
     */
    public function setAsset(Asset $asset): void
    {
        $this->asset = $asset;
    }

    /**
     * @return float
     */
    public function getCapital(): float
    {
        return $this->capital;
    }

    /**
     * @return float
     */
    public function getRevenue(): float
    {
        return $this->revenue;
    }

    /**
     * @param float $capital
     */
    public function setCapital(float $capital): void
    {
        $this->capital = $capital;
    }

    /**
     * @param float $revenue
     */
    public function setRevenue(float $revenue): void
    {
        $this->revenue = $revenue;
    }


    public function getGain(): float
    {
        return $this->revenue -$this->capital;
    }

}