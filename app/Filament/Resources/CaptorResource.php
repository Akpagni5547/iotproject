<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CaptorResource\Pages;
use App\Models\Captor;
use App\Models\Controller;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class CaptorResource extends Resource
{
    protected static ?string $model = Captor::class;

    protected static ?string $navigationLabel = 'Capteurs';
    protected static ?string $modelLabel = 'Capteurs';
    protected static ?string $navigationGroup = 'Capteurs et valeurs';
    protected static ?int $navigationSort = 1;


    protected static ?string $navigationIcon = 'heroicon-o-eye';

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
            'index' => Pages\ListCaptors::route('/'),
            'create' => Pages\CreateCaptor::route('/create'),
            'edit' => Pages\EditCaptor::route('/{record}/edit'),
        ];
    }
}
