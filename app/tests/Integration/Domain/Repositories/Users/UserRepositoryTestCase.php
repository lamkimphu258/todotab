<?php

namespace App\Tests\Integration\Domain\Repositories\Users;

use App\Tests\Integration\Domain\Repositories\RepositoryTestCase;

abstract class UserRepositoryTestCase extends RepositoryTestCase
{
    protected const EMAIL = 'email@example.com';

    protected const PASSWORD = 'password123ST@';

    protected const USERNAME = 'username';
}
