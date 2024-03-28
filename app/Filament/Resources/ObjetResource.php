<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ObjetResource\Pages;
use App\Models\Client;
use App\Models\Objet;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class ObjetResource extends Resource
{
    protected static ?string $model = Objet::class;

    protected static ?string $navigationLabel = 'Objets';
    protected static ?string $modelLabel = 'Objets';
    protected static ?string $navigationGroup = 'Projets et Objets';
    protected static ?int $navigationSort = 2;

//    protected static ?string $navigationIcon = 'heroicon-o-bars-4';

    public static function form(Form $form): Form
    {
        $user_id = Auth::id();
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->label('Name')
                    ->maxLength(255),
                TextInput::make('code')
                    ->required()
                    ->label('Code')
                    ->maxLength(20),
                TextInput::make('elements')
                    ->required()
                    ->label('Elements')
                    ->maxLength(255),
                TextInput::make('description')
                    ->required()
                    ->label('Description')
                    ->maxLength(255),
                TextInput::make('position')
                    ->required()
                    ->label('Position')
                    ->maxLength(255),
                Select::make('project_id')
                    ->required()
                    ->label('Projet')
                    ->options(Project::all()->pluck('name', 'id'))
                    ->searchable(),
                Select::make('user_id')
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
                Tables\Columns\TextColumn::make('code')
                    ->searchable()
                    ->sortable()
                    ->label('Code'),
                Tables\Columns\TextColumn::make('position')
                    ->searchable()
                    ->sortable()
                    ->label('Position'),
                Tables\Columns\TextColumn::make('elements')
                    ->label('Elements'),
                Tables\Columns\TextColumn::make('description')
                    ->label('Description'),
                Tables\Columns\TextColumn::make('project.name')
                    ->searchable()
                    ->sortable()
                    ->label('Projet'),
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
            'index' => Pages\ListObjets::route('/'),
            'create' => Pages\CreateObjet::route('/create'),
            'edit' => Pages\EditObjet::route('/{record}/edit'),
        ];
    }
}
