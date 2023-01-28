<?php

namespace App\Handler;

use App\Model\AttributeFactory;
use Doctrine\ORM\EntityManagerInterface;

class AttributeListHandlerAbstract
{
    protected const ATTRIBUTE_TYPE = null;

    public function __construct(
        private AttributeFactory $attributeFactory,
        private EntityManagerInterface $entityManager
    )
    {
    }

    protected function getAttributeType()
    {
        return static::ATTRIBUTE_TYPE;
    }

    public function handle(): array
    {
        $classNAme = $this->attributeFactory->getAttributeClass($this->getAttributeType());
        $repository = $this->entityManager->getRepository($classNAme);
        return $repository->findAll();
    }

}