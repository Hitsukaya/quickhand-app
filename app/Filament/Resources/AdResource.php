<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdResource\Pages;
use App\Filament\Resources\AdResource\RelationManagers;
use App\Models\Ad;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AdResource extends Resource
{
    protected static ?string $model = Ad::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Anunțuri';
    protected static ?string $pluralModelLabel = 'Anunțuri';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
               Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Select::make('category_id')
                    ->label('Categorie')
                    ->relationship('category', 'name')
                    ->required(),

                Forms\Components\Select::make('location_id')
                    ->label('Locație')
                    ->relationship('location', 'name')
                    ->nullable(),

                Forms\Components\Textarea::make('short_description')
                    ->maxLength(500)
                    ->rows(2),

                Forms\Components\Textarea::make('full_description')
                    ->rows(4),

                Forms\Components\TextInput::make('people_needed')
                    ->label('Număr persoane necesare')
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(20)
                    ->required(),

                Forms\Components\TextInput::make('reward')
                    ->maxLength(100)
                    ->nullable(),

                Forms\Components\Select::make('job_duration_minutes')
                    ->label('Durată estimată (minute)')
                    ->options([
                        30 => '30 minute',
                        60 => '1 oră',
                        90 => '1 oră 30 min',
                        120 => '2 ore',
                        180 => '3 ore',
                        240 => '4 ore',
                    ])
                    ->required(),

                Forms\Components\TextInput::make('phone_number')
                    ->label('Telefon')
                    ->maxLength(20)
                    ->required(),

                Forms\Components\DateTimePicker::make('posted_at')
                    ->label('Data publicării')
                    ->required(),

                Forms\Components\DateTimePicker::make('expires_at')
                    ->label('Data expirării')
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('category.name')->label('Categorie')->sortable(),
                Tables\Columns\TextColumn::make('location.name')->label('Locație')->sortable(),
                Tables\Columns\TextColumn::make('people_needed')->label('Persoane'),
                Tables\Columns\TextColumn::make('reward')->sortable(),
                Tables\Columns\TextColumn::make('posted_at')->dateTime('d/m/Y H:i')->sortable(),
                Tables\Columns\TextColumn::make('expires_at')->dateTime('d/m/Y H:i')->sortable(),
            ])
            ->filters([
                Tables\Filters\Filter::make('expired')
                    ->label('Expirate')
                    ->query(fn ($query) => $query->where('expires_at', '<', now())),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListAds::route('/'),
            'create' => Pages\CreateAd::route('/create'),
            'view' => Pages\ViewAd::route('/{record}'),
            'edit' => Pages\EditAd::route('/{record}/edit'),
        ];
    }
}
