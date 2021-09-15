<?php

namespace App\Actions\Dtos\Users;

use App\Actions\Dtos\ObjectDtoInterface;
use DateTimeImmutable;

/**
 * @codeCoverageIgnore
 */
class UserObjectDto implements ObjectDtoInterface
{
    /**
     * @param string $id
     * @param string $email
     * @param string $username
     * @param DateTimeImmutable $createdAt
     * @param DateTimeImmutable $updatedAt
     */
    public function __construct(
        public string $id,
        public string $email,
        public string $username,
        public DateTimeImmutable $createdAt,
        public DateTimeImmutable $updatedAt
    ) {
    }
}
