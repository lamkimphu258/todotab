<?php

namespace App\Filters;

use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class AbstractFilter implements FilterInterface
{
    /**
     * @param ValidatorInterface $validator
     */
    public function __construct(
        protected ValidatorInterface $validator
    ) {
    }
}
