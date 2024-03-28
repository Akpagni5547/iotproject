<?php

namespace App\Filament\Resources;
use App\Filament\Resources\CaptorResource\Pages;

use App\Models\Captor;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Columns\TextColumn;

class CaptorResource extends Resource
{
    protected static ?string $model = Captor::class;

    protected static ?string $navigationLabel = 'Capteurs';
    protected static ?string $modelLabel = 'Capteurs';
    protected static ?string $navigationGroup = 'Valeurs';
    protected static ?int $navigationSort = 1;


    protected static ?string $navigationIcon = 'heroicon-o-eye';

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
            'index' => Pages\ListCaptors::route('/'),
        ];
    }
}
