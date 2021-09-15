<?php

namespace App\Domain\Entities\Users;

use App\Domain\Entities\EntityPropertyName;

/**
 * @codeCoverageIgnore
 */
class UserPropertyName extends EntityPropertyName
{
    public const EMAIL = 'email';

    public const PASSWORD = 'password';

    public const USERNAME = 'username';
}
