<?php

namespace App\Filament\Resources\ControllerResource\Pages;

use App\Filament\Resources\ControllerResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditController extends EditRecord
{
    protected static string $resource = ControllerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
