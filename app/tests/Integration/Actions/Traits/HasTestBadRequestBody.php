<?php

namespace App\Tests\Integration\Actions\Traits;


use Symfony\Component\HttpFoundation\Response;

trait HasTestBadRequestBody
{
    public function testBadRequestHttpExceptionInRequestBody()
    {
        $this->client->jsonRequest(
            self::HTTP_METHOD,
            self::URI,
            self::INVALID_REQUEST_BODY,
        );
        $this->assertEquals(
            Response::HTTP_BAD_REQUEST,
            $this->client->getResponse()->getStatusCode()
        );
    }
}
