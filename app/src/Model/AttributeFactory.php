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
            'category'  =>  new Category(),
            'type'      =>  new Type(),
            'risk'      =>  new Risk(),
            default => throw new \Exception('attributo non riconosciuto')
        };

        $attribute->setName($name);
        $attribute->setCode($this->converter->convert($name)->toKebab());

        return $attribute;
    }

    public function getAttributeClass(string $name)
    {
        return match ($name) {
            'category'  =>  Category::class,
            'type'      =>  Type::class,
            'risk'      =>  Risk::class,
            default     => throw new \Exception('attributo non riconosciuto')
        };
    }

}