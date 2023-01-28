<?php

namespace App\Handler;

use App\Model\AttributeFactory;
use App\Model\AttributeInterface;
use Doctrine\ORM\EntityManagerInterface;

class AttributeCreateHandlerAbstract
{
    protected const ATTRIBUTE_TYPE = null;

    public function __construct(
        private AttributeFactory $attributeFactory,
        private EntityManagerInterface $entityManager
    )
    {
    }

    public function handle(string  $name): AttributeInterface
    {
        $attribute = $this->attributeFactory->createAttribute($name, $this->getAttributeType());
        $this->entityManager->persist($attribute);
        $this->entityManager->flush();

        return $attribute;
    }

    protected function getAttributeType()
    {
        return static::ATTRIBUTE_TYPE;
    }

}