<?php

namespace App\Tests\Integration\Actions;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

abstract class RestApiTestCase extends KernelTestCase
{
    use Factories;

    use ResetDatabase;

    protected const RESPONSE_DATE_FORMAT = 'Y-m-d H:i:s.u';

    protected HttpClientInterface $httpClient;

    public function setUp(): void
    {
        self::bootKernel();

        $this->httpClient = HttpClient::createForBaseUri(
            $_ENV['APP_URL'],
            [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                ]
            ]
        );
    }
}
