<?php

namespace App\Model;

use App\Repository\CategoryRepository;
use Doctrine\DBAL\Types\Types;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\UuidInterface;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class )]
    #[ORM\Column(length: 255)]
    private UuidInterface $id;

    #[ORM\Column(type: Types::STRING ,  length: 255)]
    private string $name;

    #[ORM\Column(type: Types::STRING ,  length: 255)]
    private string $code;

    #[ORM\Column(type: Types::TEXT ,  length: 255)]
    private string $note;

    public function __construct(
        UuidInterface $id,
        string $name,
        string $code,
        string $note

    )
    {
    }

}