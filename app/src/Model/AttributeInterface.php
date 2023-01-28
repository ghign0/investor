<?php

namespace App\Model;

interface AttributeInterface
{

    public function setName(string $name): void;

    public function setCode(string $code): void;

}