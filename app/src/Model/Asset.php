<?php

namespace App\Model;

use App\Repository\AssetRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: AssetRepository::class)]
class Asset
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator' )]
    #[ORM\Column( type: UuidType::NAME, length: 255)]
    private Uuid $id;

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

    #[ORM\Column(type: Types::TEXT ,  length: 255, nullable: true)]
    private string $note;

    #[ORM\Column(type: Types::JSON, nullable: true )]
    private string $extraData;

    public function __construct(
        Uuid  $id,
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