<?php

namespace App\Filters;

use Symfony\Component\HttpFoundation\Request;

interface FilterInterface
{
    /**
     * @param Request $request
     */
    public function filter(Request $request): void;
}
