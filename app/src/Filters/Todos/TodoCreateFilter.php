<?php

namespace App\Filters\Todos;

use App\Filters\AbstractFilter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\Constraints as Assert;

class TodoCreateFilter extends AbstractFilter
{
    public function filter(Request $request): void
    {
        $requestBody = json_decode($request->getContent(), true);

        $constraints = new Assert\Collection([
            'fields' => [
                'name' => new Assert\NotBlank(),
            ]
        ]);

        $violations = $this->validator->validate(
            $requestBody,
            $constraints
        );

        if (0 !== $violations->count()) {
            throw new BadRequestHttpException($violations);
        }
    }
}
