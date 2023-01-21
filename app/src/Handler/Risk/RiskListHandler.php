<?php

namespace App\Handler\Risk;

use App\Repository\RiskRepository;

class RiskListHandler
{
    public function __construct(
        private RiskRepository $repository,
    )
    {
    }

    public function handle()
    {
        return $this->repository->findAll();
    }

}