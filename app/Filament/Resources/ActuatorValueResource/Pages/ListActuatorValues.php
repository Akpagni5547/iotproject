<?php

namespace App\Filament\Resources\ActuatorValueResource\Pages;

use App\Filament\Resources\ActuatorValueResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListActuatorValues extends ListRecords
{
    protected static string $resource = ActuatorValueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
