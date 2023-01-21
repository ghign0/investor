<?php

namespace App\Model;

use App\Repository\CategoryRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator' )]
    #[ORM\Column( type: UuidType::NAME, length: 255)]
    private Uuid $id;

    #[ORM\Column(type: Types::STRING ,  length: 255)]
    private string $name;

    #[ORM\Column(type: Types::STRING ,  length: 255)]
    private string $code;

    #[ORM\Column(type: Types::TEXT ,  length: 255, nullable: true)]
    private string $note;

    public function __construct(
        ?Uuid $id,
        string $name,
        string $code,
        string $note

    )
    {
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
    public function getName(): string
    {
        return $this->name;
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
    public function getNote(): string
    {
        return $this->note;
    }

}