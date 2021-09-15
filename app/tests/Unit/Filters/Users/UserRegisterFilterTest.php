<?php

namespace App\Tests\Unit\Filters\Users;

use App\Filters\Users\UserRegisterFilter;
use App\Tests\Unit\Filters\UserFilterTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserRegisterFilterTest extends UserFilterTestCase
{
    /**
     * @dataProvider providerTestFilterBadRequestHttpException
     */
    public function testFilterBadRequestHttpException(
        string $email,
        string $password,
        string $username
    )
    {
        $request = $this->createMock(Request::class);
        $request->expects($this->once())
            ->method('getContent')
            ->with()
            ->willReturn(json_encode([$email, $password, $username]));

        $constraintViolationList = $this->createMock(ConstraintViolationList::class);
        $constraintViolationList->expects($this->once())
            ->method('count')
            ->with()
            ->willReturn(self::HAVE_ERRORS);
        $constraintViolationList->expects($this->once())
            ->method('__toString')
            ->with()
            ->willReturn(self::INVALID_REQUEST_BODY_MESSAGE);

        $validatorInterface = $this->createMock(ValidatorInterface::class);
        $validatorInterface->expects($this->once())
            ->method('validate')
            ->with()
            ->willReturn($constraintViolationList);

        $filter = new UserRegisterFilter($validatorInterface);

        $this->expectException(BadRequestHttpException::class);
        $this->expectExceptionMessage(self::INVALID_REQUEST_BODY_MESSAGE);

        $filter->filter($request);
    }

    /**
     * @return array
     */
    public function providerTestFilterBadRequestHttpException(): array
    {
        return [
            [
                'email' => '',
                'password' => '',
                'username' => '',
            ],
            [
                'email' => 'example',
                'password' => '',
                'username' => '',
            ],
            [
                'email' => self::VALID_REQUEST_BODY['email'],
                'password' => 'a',
                'username' => '',
            ],
            [
                'email' => self::VALID_REQUEST_BODY['email'],
                'password' => 'aA',
                'username' => '',
            ],
            [
                'email' => self::VALID_REQUEST_BODY['email'],
                'password' => 'aA1',
                'username' => '',
            ],
            [
                'email' => self::VALID_REQUEST_BODY['email'],
                'password' => 'aA1@',
                'username' => '',
            ],
            [
                'email' => self::VALID_REQUEST_BODY['email'],
                'password' => self::VALID_REQUEST_BODY['password'],
                'username' => '',
            ],
            [
                'email' => self::VALID_REQUEST_BODY['email'],
                'password' => self::VALID_REQUEST_BODY['password'],
                'username' => self::VALID_REQUEST_BODY['username'],
            ]
        ];
    }

    public function testFilterSuccess() {
        $request = $this->createMock(Request::class);
        $request->expects($this->once())
            ->method('getContent')
            ->with()
            ->willReturn(json_encode(self::VALID_REQUEST_BODY));

        $constraintViolationList = $this->createMock(ConstraintViolationList::class);
        $constraintViolationList->expects($this->once())
            ->method('count')
            ->with()
            ->willReturn(self::HAVE_NO_ERROR);

        $validatorInterface = $this->createMock(ValidatorInterface::class);
        $validatorInterface->expects($this->once())
            ->method('validate')
            ->with()
            ->willReturn($constraintViolationList);

        $filter = new UserRegisterFilter($validatorInterface);

        $this->assertNull($filter->filter($request));
    }
}
