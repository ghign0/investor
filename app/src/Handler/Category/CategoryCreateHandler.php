<?php

namespace App\Handler\Category;

use App\Handler\AttributeCreateHandlerAbstract;
use App\Model\Category;
use Doctrine\ORM\EntityManagerInterface;

class CategoryCreateHandler extends AttributeCreateHandlerAbstract
{
    protected const ATTRIBUTE_TYPE = 'category';
}