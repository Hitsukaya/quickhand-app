<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdApplicationResource\Pages;
use App\Filament\Resources\AdApplicationResource\RelationManagers;
use App\Models\AdApplication;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AdApplicationResource extends Resource
{
    protected static ?string $model = AdApplication::class;

    protected static ?string $navigationIcon = 'heroicon-o-check';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('ad_id')
                    ->label('Anunț')
                    ->relationship('ad', 'title')
                    ->required()
                    ->searchable(),
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required()
                    ->searchable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID')->sortable(),
                Tables\Columns\TextColumn::make('ad.title')->label('Anunt')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('user.name')->label('Utilizator')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->label('Data aplicarii')->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListAdApplications::route('/'),
            'create' => Pages\CreateAdApplication::route('/create'),
            'edit' => Pages\EditAdApplication::route('/{record}/edit'),
        ];
    }
}
