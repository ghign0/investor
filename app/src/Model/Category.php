<?php

namespace App\Model;

use App\Repository\CategoryRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Jawira\CaseConverter\Convert;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category extends AttributeAbstract
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator' )]
    #[ORM\Column( type: UuidType::NAME, length: 255)]
    protected Uuid $id;

    #[ORM\Column(type: Types::STRING ,  length: 255)]
    protected  string $name;

    #[ORM\Column(type: Types::STRING ,  length: 255)]
    protected  string $code;

    #[ORM\Column(type: Types::TEXT ,  length: 255, nullable: true)]
    protected  string $note;

}