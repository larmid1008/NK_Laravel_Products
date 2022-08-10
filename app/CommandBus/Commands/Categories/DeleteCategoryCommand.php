<?php

namespace App\CommandBus\Commands\Categories;

use App\CommandBus\Commands\BaseCommand;
use App\CommandBus\DataTransferObjects\Categories\DeleteCategoryDTO;
use App\Models\Category;
use App\Models\CategoryProducts;
use Illuminate\Http\Response;
use Spatie\DataTransferObject\DataTransferObject;

class DeleteCategoryCommand extends BaseCommand
{
    /**
     * @param DeleteCategoryDTO $dto
     * @return void
     * @throws \Exception
     */
    public function executeCommand(DataTransferObject $dto): void
    {
        if(CategoryProducts::query()->where("category_id", $dto->id)->first()) {
            throw new \Exception("Category have products", Response::HTTP_BAD_REQUEST);
        }

        Category::findOrFail($dto->id)?->delete();
    }
}
