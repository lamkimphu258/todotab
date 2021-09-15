<?php

namespace App\Tests\Unit\Actions\DtoMappers\Users;

use App\Actions\DtoMappers\Users\UserObjectDtoMapper;
use App\Actions\Dtos\DtoInterface;
use App\Actions\Dtos\ObjectDtoInterface;
use App\Domain\Entities\Users\User;
use App\Domain\Entities\Users\UserPropertyName;
use App\Factory\UserFactory;
use App\Tests\Unit\Actions\DtoMappers\DtoMapperTestCase;
use DateTimeImmutable;

class UserObjectDtoMapperTest extends DtoMapperTestCase
{
    public function testToDto()
    {
        $userFactory = UserFactory::createOne();

        $createdAt = new DateTimeImmutable();
        $updatedAt = new DateTimeImmutable();

        $user = $this->createMock(User::class);
        $user->expects($this->once())
            ->method('getId')
            ->with()
            ->willReturn(self::ID);
        $user->expects($this->once())
            ->method('getEmail')
            ->with()
            ->willReturn($userFactory->getEmail());
        $user->expects($this->once())
            ->method('getUsername')
            ->with()
            ->willReturn($userFactory->getUsername());
        $user->expects($this->once())
            ->method('getCreatedAt')
            ->with()
            ->willReturn($createdAt);
        $user->expects($this->once())
            ->method('getUpdatedAt')
            ->with()
            ->willReturn($updatedAt);

        $dtoMapper = new UserObjectDtoMapper();
        $dto = $dtoMapper->toDto($user);

        $this->assertInstanceOf(ObjectDtoInterface::class, $dto);
        $this->assertInstanceOf(DtoInterface::class, $dto);

        $this->assertObjectHasAttribute(UserPropertyName::ID, $dto);
        $this->assertObjectHasAttribute(UserPropertyName::EMAIL, $dto);
        $this->assertObjectNotHasAttribute(UserPropertyName::PASSWORD, $dto);
        $this->assertObjectHasAttribute(UserPropertyName::USERNAME, $dto);
        $this->assertObjectHasAttribute(UserPropertyName::CREATED_AT, $dto);
        $this->assertObjectHasAttribute(UserPropertyName::UPDATED_AT, $dto);

        $this->assertEquals(self::ID, $dto->id);
        $this->assertEquals($userFactory->getEmail(), $dto->email);
        $this->assertEquals($userFactory->getUsername(), $dto->username);
        $this->assertEquals($createdAt, $dto->createdAt);
        $this->assertEquals($updatedAt, $dto->updatedAt);
    }
}
