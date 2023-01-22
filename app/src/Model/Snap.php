<?php

namespace App\Model;

use Symfony\Component\Uid\Uuid;

class Snap
{
    private Uuid $id;

    private Asset $asset;

    private float $invested;

    private float $notInvested;

    private float $value;

    private float $gain;

}