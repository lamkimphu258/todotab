<?php

namespace App\Filters\Todos;

use App\Filters\AbstractFilter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\Constraints as Assert;

class TodoIndexFilter extends AbstractFilter
{
    /**
     * @param  Request  $request
     * @codeCoverageIgnore
     */
    public function filter(Request $request): void
    {
    }
}
