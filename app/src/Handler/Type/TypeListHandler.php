<?php

namespace App\Handler\Type;

use App\Handler\AttributeListHandlerAbstract;
use App\Model\Attributes;

class TypeListHandler extends AttributeListHandlerAbstract
{
    protected const ATTRIBUTE_TYPE = Attributes::TYPE;
}