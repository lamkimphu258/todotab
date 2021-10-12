<?php

namespace App\Tests\Unit\Filters\Todos;

use App\Filters\Todos\TodoCreateFilter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class TodoCreateFilterTest extends TodoFilterTestCase
{
    public function testFilterThrowBadRequestHttpException()
    {
        $request = $this->createMock(Request::class);
        $request->expects($this->once())
            ->method('getContent')
            ->with()
            ->willReturn(
                json_encode([
                    'name' => ''
                ])
            );

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

        $filter = new TodoCreateFilter($validatorInterface);

        $this->expectException(BadRequestHttpException::class);
        $this->expectExceptionMessage(self::INVALID_REQUEST_BODY_MESSAGE);

        $filter->filter($request);
    }

    public function testFilterSuccess()
    {
        $request = $this->createMock(Request::class);
        $request->expects($this->once())
            ->method('getContent')
            ->with()
            ->willReturn(
                json_encode(self::VALID_REQUEST_BODY)
            );

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

        $filter = new TodoCreateFilter($validatorInterface);

        $this->assertNull($filter->filter($request));
    }
}
