<?php

namespace App\Handler\Asset;

use App\Model\ValueObject\Asset;
use App\Model\Category;
use App\Model\Risk;
use App\Model\Type;
use Doctrine\ORM\EntityManagerInterface;

class AssetCreateHandler
{

    public function __construct(
        private EntityManagerInterface $entityManager
    )
    {
    }

    public function handle(string $nameChosen, string $parentChosen, Category $category, Type $type, Risk $risk)
    {
        $asset = new Asset();

        $asset->createNewAsset(
            name: $nameChosen,
            parent: $parentChosen,
            category: $category,
            type: $type,
            risk: $risk
        );

        $this->entityManager->persist($asset);
        $this->entityManager->flush();


        return $asset;
    }

}