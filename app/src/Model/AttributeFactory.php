<?php

namespace App\Model;

use Jawira\CaseConverter\CaseConverter;

class AttributeFactory
{
    public function __construct(
        private CaseConverter $converter
    )
    {
    }

    public function createAttribute(string $name, string $attributeEntity): AttributeInterface
    {
        $attribute =  match ($attributeEntity) {
            Attributes::CATEGORY  =>  new Category(),
            Attributes::TYPE      =>  new Type(),
            Attributes::RISK      =>  new Risk(),
            default => throw new \Exception('attributo non riconosciuto')
        };

        $attribute->setName($name);
        $attribute->setCode($this->converter->convert($name)->toKebab());

        return $attribute;
    }

    public function getAttributeClass(string $name)
    {
        return match ($name) {
            Attributes::CATEGORY  =>  Category::class,
            Attributes::TYPE      =>  Type::class,
            Attributes::RISK      =>  Risk::class,
            default     => throw new \Exception('attributo non riconosciuto')
        };
    }

}