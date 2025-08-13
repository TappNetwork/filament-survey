<?php

namespace Tapp\FilamentSurvey\Resources;

use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Tapp\FilamentSurvey\Resources\EntryResource\Pages\ListEntries;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use MattDaneshvar\Survey\Models\Entry;
use Tapp\FilamentSurvey\Resources\EntryResource\Pages;

class EntryResource extends Resource
{
    protected static ?string $model = Entry::class;

    public static function getNavigationIcon(): string
    {
        return config('filament-survey.navigation.entry.icon');
    }

    public static function getNavigationSort(): ?int
    {
        return config('filament-survey.navigation.entry.sort');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament-survey::filament-survey.navigation.group');
    }

    public static function getLabel(): string
    {
        return __('filament-survey::filament-survey.navigation.entry.label');
    }

    public static function getPluralLabel(): string
    {
        return __('filament-survey::filament-survey.navigation.entry.plural-label');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('survey.name'),
                TextColumn::make('participant.name'),
                TextColumn::make('created_at')
                    ->dateTime(),
                TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            ->filters([
                //
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
            'index' => ListEntries::route('/'),
            //'create' => Pages\CreateEntry::route('/create'),
            //'edit' => Pages\EditEntry::route('/{record}/edit'),
        ];
    }
}
