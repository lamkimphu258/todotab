<?php

namespace App\Tests\Unit\Filters;

use PHPUnit\Framework\TestCase;

abstract class FilterTestCase extends TestCase
{
    protected const INVALID_REQUEST_BODY_MESSAGE = 'invalid-request-body-message';

    protected const HAVE_ERRORS = 1;

    protected const HAVE_NO_ERROR = 0;
}
