<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActuatorResource\Pages;
use App\Models\Actuator;
use App\Models\Client;
use App\Models\Controller;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class ActuatorResource extends Resource
{
    protected static ?string $model = Actuator::class;

    protected static ?string $navigationLabel = 'Actuateurs';
    protected static ?string $modelLabel = 'Actuateurs';
    protected static ?string $navigationGroup = 'Actuateurs et valeurs';
    protected static ?int $navigationSort = 1;

//    protected static ?string $navigationIcon = 'heroicon-o-arrows-right-left';

    public static function form(Form $form): Form
    {
        $user_id = Auth::id();
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('Name')
                    ->maxLength(255),
                Forms\Components\TextInput::make('description')
                    ->required()
                    ->label('Description')
                    ->maxLength(255),
                Forms\Components\Select::make('controller_id')
                    ->required()
                    ->label('Microcontrolleur')
                    ->options(Controller::all()->pluck('name', 'id'))
                    ->searchable(),
                Forms\Components\Select::make('user_id')
                    ->disabled()
                    ->default($user_id)
                    ->relationship('user', 'name')
                    ->label('Créé par')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label('Name'),
                Tables\Columns\TextColumn::make('description')
                    ->label('Description'),
                Tables\Columns\TextColumn::make('controller.name')
                    ->searchable()
                    ->sortable()
                    ->label('Microcontrolleur'),
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable()
                    ->sortable()
                    ->label('Créé par'),
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
            'index' => Pages\ListActuators::route('/'),
            'create' => Pages\CreateActuator::route('/create'),
            'edit' => Pages\EditActuator::route('/{record}/edit'),
        ];
    }
}
