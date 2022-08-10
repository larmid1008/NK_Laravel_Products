<?php

namespace App\CommandBus\Commands\Products;

use App\CommandBus\Commands\BaseCommand;
use App\CommandBus\DataTransferObjects\Products\CreateProductDTO;
use App\Models\Product;
use Spatie\DataTransferObject\DataTransferObject;

class CreateProductCommand extends BaseCommand
{
    /**
     * @param CreateProductDTO $dto
     * @return Product
     */
    public function executeCommand(DataTransferObject $dto): Product
    {
        $product = new Product(
            [
                "title" => $dto->title,
                "description"=> $dto->description,
                "price" => $dto->price,
                "image_url" => $dto->imageURL,
                "publish_at" => $dto->publishedAt,
            ]
        );
        $product->save();

        return $product->fresh();
    }

}
