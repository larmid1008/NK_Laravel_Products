<?php

namespace App\CommandBus\Commands;

use Spatie\DataTransferObject\DataTransferObject;

interface ICommand {
    public function execute(): ?DataTransferObject;
}
