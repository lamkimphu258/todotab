<?php

namespace App\Tests\Unit\Responders;

use PHPUnit\Framework\TestCase;
use Zenstruck\Foundry\Test\Factories;

abstract class RestApiResponderTestCase extends TestCase
{
    use Factories;

    protected const EXISTING_ID = 'existing-id';

    protected const RESPONSE_DATE_FORMAT = 'Y-m-d H:i:s.u';
}
