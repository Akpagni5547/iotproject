<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActuatorResource\Pages;
use App\Models\Actuator;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Columns\TextColumn;

class ActuatorResource extends Resource
{
    protected static ?string $model = Actuator::class;

    protected static ?string $navigationLabel = 'Actuateurs';
    protected static ?string $modelLabel = 'Actuateurs';
    protected static ?string $navigationGroup = 'Valeurs';
    protected static ?int $navigationSort = 1;

//    protected static ?string $navigationIcon = 'heroicon-o-arrows-right-left';

    public static function canCreate(): bool
    {
        return false;
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->searchable()
                    ->sortable()
                    ->label('Id'),
                TextColumn::make('created_at')
                    ->sortable()
                    ->since()
            ])
            ->filters([
                //
            ])
            ->actions([
            ])
            ->bulkActions([
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListActuators::route('/'),
        ];
    }
}
