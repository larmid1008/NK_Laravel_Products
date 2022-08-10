<?php

namespace App\CommandBus\DataTransferObjects\Categories;

use Spatie\DataTransferObject\Attributes\Strict;
use Spatie\DataTransferObject\DataTransferObject;

#[Strict]
class DeleteCategoryDTO extends DataTransferObject
{
    public int $id;
}
