<?php

namespace App\Handler\Asset;

use App\Repository\AssetRepository;

class AssetListHandler
{
    public function __construct(
        private AssetRepository $repository
    )
    {
    }

    public function handle()
    {
        $assets = $this->repository->findAll();

        return $assets;

    }

}