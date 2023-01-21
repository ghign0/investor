<?php

namespace App\Handler\Category;


use App\Model\Category;

class CateogryCreateCommand
{
    public function __construct(
        private Category $category
    )
    {
    }

    /**
     * @return Category
     */
    public function getCategory(): Category
    {
        return $this->category;
    }

}