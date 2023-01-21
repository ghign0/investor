<?php

namespace App\Model;

use App\Repository\AssetRepository;
use Doctrine\DBAL\Types\Types;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\UuidInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AssetRepository::class)]
class Asset
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class )]
    #[ORM\Column(length: 255)]
    private UuidInterface $id;

    #[ORM\Column(type: Types::STRING ,  length: 255)]
    private string $parent;

    #[ORM\Column(type: Types::STRING ,  length: 255)]
    private string $name;

    #[ORM\Column(type: Types::STRING ,  length: 255)]
    private string $code;

    #[ORM\ManyToOne(targetEntity: Category::class)]
    private Category $category;

    #[ORM\ManyToOne(targetEntity: Type::class)]
    private Type $type;

    #[ORM\ManyToOne(targetEntity: Risk::class)]
    private Risk $risk;

    #[ORM\Column(type: Types::TEXT ,  length: 255)]
    private string $note;

    #[ORM\Column(type: Types::JSON )]
    private string $extraData;

    public function __construct(
        UuidInterface  $id,
        string $parent,
        string $name,
        string $code,
        Category $category,
        Type $type,
        Risk $risk,
        string $note,
        string $extraData
    )
    {
    }

}