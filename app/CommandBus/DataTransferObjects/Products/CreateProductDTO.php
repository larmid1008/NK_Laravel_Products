<?php

namespace App\CommandBus\DataTransferObjects\Products;

use DateTimeImmutable;
use Spatie\DataTransferObject\Attributes\Strict;
use Spatie\DataTransferObject\DataTransferObject;

#[Strict]
class CreateProductDTO extends DataTransferObject
{
    public string $title;
    public ?string $description = "";
    public float $price;
    public ?string $imageURL = "";
    public ?DateTimeImmutable $publishedAt = null;
    public ?array $categoryIds;
}
