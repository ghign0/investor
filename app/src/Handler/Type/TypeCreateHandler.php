<?php

namespace App\Handler\Type;

use App\Handler\AttributeCreateHandlerAbstract;
use App\Model\Attributes;

class TypeCreateHandler extends AttributeCreateHandlerAbstract
{
    protected const ATTRIBUTE_TYPE = Attributes::TYPE;

}