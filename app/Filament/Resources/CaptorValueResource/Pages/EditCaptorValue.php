<?php

namespace App\Filament\Resources\CaptorValueResource\Pages;

use App\Filament\Resources\CaptorValueResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCaptorValue extends EditRecord
{
    protected static string $resource = CaptorValueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
