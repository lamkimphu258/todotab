<?php

namespace App\Tests\Unit\Actions;

use PHPUnit\Framework\TestCase;
use Zenstruck\Foundry\Test\Factories;

abstract class ActionTestCase extends TestCase
{
    use Factories;

    protected const ID = 'id';

    protected const INVALID_REQUEST_BODY_MESSAGE = 'invalid-request-body-message';

    protected const RESPONSE_DATE_FORMAT = 'Y-m-d H:i:s.u';
}
