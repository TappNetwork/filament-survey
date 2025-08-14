<?php

namespace Tapp\FilamentSurvey\Resources;

use Filament\Forms\Form;
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

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('survey.name'),
                Tables\Columns\TextColumn::make('participant.name'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
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
            'index' => Pages\ListEntries::route('/'),
            // 'create' => Pages\CreateEntry::route('/create'),
            // 'edit' => Pages\EditEntry::route('/{record}/edit'),
        ];
    }
}
