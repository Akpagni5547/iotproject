<?php

namespace App\Filament\Resources\ObjetResource\Pages;

use App\Filament\Resources\ObjetResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListObjets extends ListRecords
{
    protected static string $resource = ObjetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
