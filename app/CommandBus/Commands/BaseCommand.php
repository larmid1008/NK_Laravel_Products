<?php


namespace App\CommandBus\Commands;

use Spatie\DataTransferObject\DataTransferObject;
use \Illuminate\Support\Facades\DB;

abstract class BaseCommand
{
    protected bool $isTransactional = true;
    protected int $numberOfAttempts = 1;

    /**
     * @param DataTransferObject $dto
     */
    public function __construct(private readonly DataTransferObject $dto)
    {
    }

    final public function execute()
    {
        if(!$this->isTransactional) {
            return $this->executeCommand($this->dto);
        }

        return DB::transaction(function() {
            return $this->executeCommand($this->dto);
        }, $this->numberOfAttempts);
    }

    abstract protected function executeCommand(DataTransferObject $dto);
}
