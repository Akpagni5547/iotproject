<?php

namespace App\Filament\Resources\ProjectResource\RelationManagers;

use App\Models\Project;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Support\Facades\Auth;

class ObjetsRelationManager extends RelationManager
{
    protected static string $relationship = 'objets';

    protected static ?string $recordTitleAttribute = 'name';

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
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('description'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
            ]);
    }
}
