<?php

namespace App\Handler\Category;

use App\Repository\CategoryRepository;

class CategoryListHandler
{

    public function __construct(
        private CategoryRepository $categoryRepository
    )
    {
    }

    public function handle(): mixed
    {
        $categories = $this->categoryRepository->findAll();

        return $categories;
    }
}