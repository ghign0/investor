<?php

namespace App\Handler\Category;

use App\Handler\AttributeListHandlerAbstract;
use App\Model\Attributes;

class CategoryListHandler extends AttributeListHandlerAbstract
{
    protected const ATTRIBUTE_TYPE = Attributes::CATEGORY;
}