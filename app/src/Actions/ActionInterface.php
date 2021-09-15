<?php

namespace App\Actions;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

interface ActionInterface
{
    public function __invoke(Request $request): JsonResponse;
}
