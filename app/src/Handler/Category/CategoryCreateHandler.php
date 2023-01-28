<?php

namespace App\Handler\Category;

use App\Handler\AttributeCreateHandlerAbstract;
use App\Model\Attributes;

class CategoryCreateHandler extends AttributeCreateHandlerAbstract
{
    protected const ATTRIBUTE_TYPE = Attributes::CATEGORY;
}