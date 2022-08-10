<?php

namespace App\CommandBus\Commands\Products;

use App\CommandBus\Commands\BaseCommand;
use App\CommandBus\DataTransferObjects\Products\UpdateProductDTO;
use App\Models\Product;
use Spatie\DataTransferObject\DataTransferObject;

class UpdateProductCommand extends BaseCommand
{
    /**
     * @param UpdateProductDTO $dto
     * @return Product
     * @throws \Throwable
     */
    public function executeCommand(DataTransferObject $dto): Product
    {
        $product = Product::findOrFail($dto->id);
        $product->updateOrFail([
                "title"       => $dto->title,
                "description" => $dto->description,
                "price"       => $dto->price,
                "image_url"   => $dto->imageURL,
                "publish_at"  => $dto->publishedAt,
            ]
        );

        if(!empty($dto->categoryIds)) {
            $product->categories()->sync($dto->categoryIds);
        }

        return $product->fresh("categories");
    }

}
