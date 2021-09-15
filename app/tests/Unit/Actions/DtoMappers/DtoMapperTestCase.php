<?php

namespace App\Tests\Unit\Actions\DtoMappers;

use PHPUnit\Framework\TestCase;
use Zenstruck\Foundry\Test\Factories;

abstract class DtoMapperTestCase extends TestCase
{
    use Factories;

    protected const ID = 'id';
}
