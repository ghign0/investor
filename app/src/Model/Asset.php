<?php

namespace App\Model;

use App\Repository\AssetRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Jawira\CaseConverter\Convert;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: AssetRepository::class)]
class Asset
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator' )]
    #[ORM\Column( type: UuidType::NAME, length: 255)]
    private ?Uuid $id;

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
    private ?string $note;

    #[ORM\Column(type: Types::JSON, nullable: true )]
    private ?string $extraData;


    public function createNewAsset(string $name, string $parent, Category $category, Type $type, Risk $risk)
    {
        $this->name = $name;
        $this->parent = $parent;
        $this->code = (new Convert($name))->toKebab();
        $this->category = $category;
        $this->type = $type;
        $this->risk = $risk;
    }

    /**
     * @return Uuid|null
     */
    public function getId(): ?Uuid
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getParent(): string
    {
        return $this->parent;
    }

    /**
     * @return Category
     */
    public function getCategory(): Category
    {
        return $this->category;
    }

    /**
     * @return Risk
     */
    public function getRisk(): Risk
    {
        return $this->risk;
    }

    /**
     * @return Type
     */
    public function getType(): Type
    {
        return $this->type;
    }

}