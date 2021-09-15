<?php

namespace App\Filters\Users;

use App\Filters\AbstractFilter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\Constraints as Assert;

class UserRegisterFilter extends AbstractFilter
{
    public function filter(Request $request): void
    {
        $requestBody = json_decode($request->getContent(), true);

        $constraints = new Assert\Collection([
            'fields' => [
                'email' => [new Assert\NotBlank(), new Assert\Email()],
                'password' => [
                    new Assert\NotBlank(),
                    new Assert\Regex('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#$!%*?&])[A-Za-z\d@#$!%*?&]{8,}$/')
                ],
                'username' => [new Assert\NotBlank()],
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
