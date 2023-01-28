<?php

namespace App\Handler\Risk;

use App\Handler\AttributeCreateHandlerAbstract;
use App\Model\Attributes;

class RiskCreateHandler extends AttributeCreateHandlerAbstract
{
    protected const ATTRIBUTE_TYPE = Attributes::RISK;

}