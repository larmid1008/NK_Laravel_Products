<?php

namespace App\CommandBus\Commands\Categories;

use App\CommandBus\Commands\BaseCommand;
use App\CommandBus\DataTransferObjects\Products\CreateProductDTO;
use App\Models\Category;
use Spatie\DataTransferObject\DataTransferObject;

class CreateCategoryCommand extends BaseCommand
{
    /**
     * @param CreateProductDTO $dto
     * @return Category
     */
    public function executeCommand(DataTransferObject $dto): Category
    {
        $category = new Category(
            [
                "title" => $dto->title,
            ]
        );
        $category->save();

        return $category->fresh();
    }
}
