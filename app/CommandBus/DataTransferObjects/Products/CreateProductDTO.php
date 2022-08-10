<?php

namespace App\CommandBus\DataTransferObjects\Products;

use App\CommandBus\Commands\Products\Strict;
use DateTimeImmutable;
use Spatie\DataTransferObject\DataTransferObject;

#[Strict]
class CreateProductDTO extends DataTransferObject
{
    public string $title;
    public ?string $description = "";
    public float $price;
    public ?string $imageURL = "";
    public ?DateTimeImmutable $publishedAt = null;
}
