<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CaptorValueResource\Pages;
use App\Models\Captor;
use App\Models\CaptorValue;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CaptorValueResource extends Resource
{
    protected static ?string $model = CaptorValue::class;

    protected static ?string $navigationLabel = 'Valeurs des capteurs';
    protected static ?string $modelLabel = 'Valeurs des capteurs';
    protected static ?string $navigationGroup = 'Capteurs et valeurs';
    protected static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('controller_id')
                    ->required()
                    ->label('Capteurs')
                    ->options(Captor::all()->pluck('name', 'id'))
                    ->searchable(),

                Forms\Components\KeyValue::make('values')
                    ->label('Valeurs')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('captor.name')
                    ->searchable()
                    ->sortable()
                    ->label('Capteur'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListCaptorValues::route('/'),
            'create' => Pages\CreateCaptorValue::route('/create'),
            'edit' => Pages\EditCaptorValue::route('/{record}/edit'),
        ];
    }
}
