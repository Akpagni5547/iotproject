<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActuatorValueResource\Pages;
use App\Models\Actuator;
use App\Models\ActuatorValue;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class ActuatorValueResource extends Resource
{
    protected static ?string $model = ActuatorValue::class;

    protected static ?string $navigationLabel = 'Valeurs des actuateurs';
    protected static ?string $modelLabel = 'Valeurs des actuateurs';
    protected static ?string $navigationGroup = 'Actuateurs et valeurs';
    protected static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('controller_id')
                    ->required()
                    ->label('Actuateur')
                    ->options(Actuator::all()->pluck('name', 'id'))
                    ->searchable(),

                Forms\Components\KeyValue::make('values')
                    ->label('Valeurs')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('actuator.name')
                    ->searchable()
                    ->sortable()
                    ->label('Actuateur'),
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
            'index' => Pages\ListActuatorValues::route('/'),
            'create' => Pages\CreateActuatorValue::route('/create'),
            'edit' => Pages\EditActuatorValue::route('/{record}/edit'),
        ];
    }
}
