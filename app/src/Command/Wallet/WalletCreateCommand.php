<?php

namespace App\Command\Wallet;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;

#[AsCommand(
    name: 'app:wallet:create',
    description: 'crea una wallet e lo collega a un asset'
)]
class WalletCreateCommand extends Command
{

}