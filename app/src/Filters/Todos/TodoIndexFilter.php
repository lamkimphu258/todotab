<?php

namespace App\Filters\Todos;

use App\Filters\FilterInterface;
use Symfony\Component\HttpFoundation\Request;

class TodoIndexFilter implements FilterInterface
{
    /**
     * @param Request $request
     * @codeCoverageIgnore
     */
    public function filter(Request $request): void
    {
        // TODO: Implement filter() method.
    }
}
