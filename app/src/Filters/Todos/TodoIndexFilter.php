<?php

namespace App\Filters\Todos;

use App\Filters\AbstractFilter;
use App\Filters\FilterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\Constraints as Assert;

class TodoIndexFilter extends AbstractFilter
{
    /**
     * @param Request $request
     * @codeCoverageIgnore
     */
    public function filter(Request $request): void
    {
        $requestBody = json_decode($request->getContent(), true);

        $constraints = new Assert\Collection([
            'fields' => [
                'email' => [new Assert\NotBlank(), new Assert\Email()],
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
