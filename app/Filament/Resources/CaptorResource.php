<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CaptorResource\Pages;
use App\Filament\Resources\CaptorResource\RelationManagers;
use App\Models\Captor;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CaptorResource extends Resource
{
    protected static ?string $model = Captor::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'create' => Pages\CreateCaptor::route('/create'),
            'edit' => Pages\EditCaptor::route('/{record}/edit'),
        ];
    }    
}
