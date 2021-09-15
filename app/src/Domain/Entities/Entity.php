<?php

namespace App\Domain\Entities;

use App\Domain\Entities\Traits\HasCreationDate;
use App\Domain\Entities\Traits\HasDeletedDate;
use App\Domain\Entities\Traits\HasUpdatedDate;
use App\Domain\Entities\Traits\HasUuid;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @Gedmo\SoftDeleteable(fieldName="deletedAt")
 * @codeCoverageIgnore
 */
class Entity implements HasCreationDateInterface, HasDeletedDateInterface, HasUpdatedDateInterface, HasUuidInterface
{
    use HasUuid;

    use HasCreationDate;

    use HasDeletedDate;

    use HasUpdatedDate;
}
