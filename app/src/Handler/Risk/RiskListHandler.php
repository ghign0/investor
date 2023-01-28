<?php

namespace App\Handler\Risk;

use App\Handler\AttributeListHandlerAbstract;
use App\Model\Attributes;

class RiskListHandler extends AttributeListHandlerAbstract
{
    protected const ATTRIBUTE_TYPE = Attributes::RISK;

}