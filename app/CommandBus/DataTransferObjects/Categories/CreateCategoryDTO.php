<?php

namespace App\CommandBus\DataTransferObjects\Categories;

use Spatie\DataTransferObject\Attributes\Strict;
use Spatie\DataTransferObject\DataTransferObject;

#[Strict]
class CreateCategoryDTO extends DataTransferObject
{
    public string $title;
}
