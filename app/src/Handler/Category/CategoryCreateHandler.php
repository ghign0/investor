<?php

namespace App\Handler\Category;

use Doctrine\ORM\EntityManagerInterface;

class CategoryCreateHandler
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    )
    {
    }

    public function handle(CateogryCreateCommand $command): mixed
    {
        $category = $command->getCategory();
        $this->entityManager->persist($category);
        $this->entityManager->flush();


    }

}