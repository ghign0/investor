<?php

namespace App\Model;

use App\Model\ValueObject\Asset;
use App\Repository\SnapRepository;
use Doctrine\DBAL\Types\Types;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SnapRepository::class)]
class Snap
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator' )]
    #[ORM\Column( type: UuidType::NAME, length: 255)]
    private Uuid $id;

    #[ORM\ManyToOne(targetEntity: Wallet::class)]
    private Wallet $asset;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private float $invested;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private float $notInvested;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private float $value;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private float $gain;

}