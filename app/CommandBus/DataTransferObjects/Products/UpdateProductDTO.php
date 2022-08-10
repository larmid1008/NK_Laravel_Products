<?php

namespace App\CommandBus\DataTransferObjects\Products;

use Spatie\DataTransferObject\Attributes\Strict;

#[Strict]
class UpdateProductDTO extends CreateProductDTO
{
    public int $id;
}
