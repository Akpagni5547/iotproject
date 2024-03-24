<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ControllerResource\Pages;
use App\Models\Client;
use App\Models\Controller;
use App\Models\Objet;
use App\Models\Project;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class ControllerResource extends Resource
{
    protected static ?string $model = Controller::class;

    protected static ?string $navigationLabel = 'Microcontrôleurs';
    protected static ?string $modelLabel = 'Microcontrôleurs';
    protected static ?string $navigationGroup = 'Projets et Objets';
    protected static ?int $navigationSort =3;

//    protected static ?string $navigationIcon = 'heroicon-o-cpu-chip';

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
                Forms\Components\Select::make('object_id')
                    ->required()
                    ->label('Objets')
                    ->options(Objet::all()->pluck('name', 'id'))
                    ->searchable(),
                Forms\Components\Select::make('client_id')
                    ->required()
                    ->label('Client')
                    ->options(Client::all()->pluck('name', 'id'))
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
                Tables\Columns\TextColumn::make('objet.name')
                    ->searchable()
                    ->sortable()
                    ->label('Objet'),
                Tables\Columns\TextColumn::make('client.name')
                    ->searchable()
                    ->sortable()
                    ->label('Client'),
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
            'index' => Pages\ListControllers::route('/'),
            'create' => Pages\CreateController::route('/create'),
            'edit' => Pages\EditController::route('/{record}/edit'),
        ];
    }
}
