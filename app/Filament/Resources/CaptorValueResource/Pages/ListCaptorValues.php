<?php

namespace App\Filament\Resources\CaptorValueResource\Pages;

use App\Filament\Resources\CaptorValueResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCaptorValues extends ListRecords
{
    protected static string $resource = CaptorValueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
