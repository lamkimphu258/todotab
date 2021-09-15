<?php

namespace App\Tests\Integration\Actions\Traits;


use Exception;
use Symfony\Component\HttpFoundation\Response;

trait HasTestBadRequestBody
{
    public function testBadRequestHttpExceptionInRequestBody()
    {
        try {
            $this->httpClient->request(
                self::HTTP_METHOD,
                self::URI,
                [
                    'json' => self::INVALID_REQUEST_BODY,
                ]
            );
        } catch (Exception $e) {
            $this->assertEquals(Response::HTTP_BAD_REQUEST, $e->getCode());
        }
    }
}
