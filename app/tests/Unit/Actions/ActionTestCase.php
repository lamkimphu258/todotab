<?php

namespace App\Tests\Unit\Actions;

use App\Domain\Entities\Users\User;
use App\Factory\UserFactory;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\Test\Factories;

abstract class ActionTestCase extends TestCase
{
    use Factories;

    protected const ID = 'id';

    protected const INVALID_REQUEST_BODY_MESSAGE = 'invalid-request-body-message';

    protected const RESPONSE_DATE_FORMAT = 'Y-m-d H:i:s.u';

    public function getUnauthenticatedUserContainer()
    {
        $tokenInterface = $this->createMock(TokenInterface::class);
        $tokenInterface->expects($this->once())
            ->method('getUser')
            ->with()
            ->willReturn(null);

        $tokenStorageInterface = $this->createMock(TokenStorageInterface::class);
        $tokenStorageInterface->expects($this->once())
            ->method('getToken')
            ->with()
            ->willReturn($tokenInterface);

        $container = $this->createMock(Container::class);
        $container->expects($this->once())
            ->method('has')
            ->with('security.token_storage')
            ->willReturn(true);
        $container->expects($this->once())
            ->method('get')
            ->with('security.token_storage')
            ->willReturn($tokenStorageInterface);

        return $container;
    }

    public function getAuthenticatedUserContainer(User $user)
    {
        $tokenInterface = $this->createMock(TokenInterface::class);
        $tokenInterface->expects($this->any())
            ->method('getUser')
            ->with()
            ->willReturn($user);

        $tokenStorageInterface = $this->createMock(TokenStorageInterface::class);
        $tokenStorageInterface->expects($this->any())
            ->method('getToken')
            ->with()
            ->willReturn($tokenInterface);

        $container = $this->createMock(Container::class);
        $container->expects($this->any())
            ->method('has')
            ->with('security.token_storage')
            ->willReturn(true);
        $container->expects($this->any())
            ->method('get')
            ->with('security.token_storage')
            ->willReturn($tokenStorageInterface);

        return $container;
    }
}
