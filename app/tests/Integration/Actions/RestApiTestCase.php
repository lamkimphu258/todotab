<?php

namespace App\Tests\Integration\Actions;

use App\Domain\Repositories\Users\UserRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

abstract class RestApiTestCase extends WebTestCase
{
    use Factories;

    use ResetDatabase;

    protected const RESPONSE_DATE_FORMAT = 'Y-m-d H:i:s.u';

    protected KernelBrowser $client;

    public function setUp(): void
    {
        $this->client = $this->createClient();
    }


    protected function createAuthenticatedUser()
    {
        $userRepository = $this->getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByUsername('test');
        $this->client->loginUser($testUser);
    }
}
