<?php

namespace App\Handler\Category;

use App\Model\Category;
use Doctrine\ORM\EntityManagerInterface;

class CategoryCreateHandler
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    )
    {
    }

    public function handle(string $nome): Category
    {
        $category = new Category();
        $category->createNewCategory($nome);
        $this->entityManager->persist($category);
        $this->entityManager->flush();

        return $category;
    }

}