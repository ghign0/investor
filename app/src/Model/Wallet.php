<?php

namespace App\Model;

use Symfony\Component\Uid\Uuid;

class Wallet
{

    private Uuid $id;

    private Asset $asset;

    private float  $capital;

    private float $revenue;

    private float $gain;

}