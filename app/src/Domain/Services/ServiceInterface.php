<?php

namespace App\Domain\Services;

use App\Domain\Commands\CommandInterface;

interface ServiceInterface
{
    public function handle(CommandInterface $command);
}
