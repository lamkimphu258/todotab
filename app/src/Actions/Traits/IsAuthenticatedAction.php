<?php

namespace App\Actions\Traits;

use Symfony\Component\Security\Core\Exception\AuthenticationException;

trait IsAuthenticatedAction
{
    public function isAuthenticatedOrFail()
    {
        if (is_null($this->getUser())) {
            throw new AuthenticationException();
        }
    }
}
