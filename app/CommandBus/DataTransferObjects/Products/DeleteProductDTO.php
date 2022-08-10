<?php

namespace App\CommandBus\DataTransferObjects\Products;

use App\CommandBus\Commands\Products\Strict;
use Spatie\DataTransferObject\DataTransferObject;

#[Strict]
class DeleteProductDTO extends DataTransferObject
{
    public int $id;
}
