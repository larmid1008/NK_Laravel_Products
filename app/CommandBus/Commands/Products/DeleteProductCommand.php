<?php

namespace App\CommandBus\Commands\Products;

use App\CommandBus\Commands\BaseCommand;
use App\CommandBus\DataTransferObjects\Products\DeleteProductDTO;
use App\Models\Product;
use Spatie\DataTransferObject\DataTransferObject;

class DeleteProductCommand extends BaseCommand
{
    /**
     * @param DeleteProductDTO $dto
     * @return void
     */
    public function executeCommand(DataTransferObject $dto): void
    {
        Product::findOrFail($dto->id)?->delete();
    }
}
