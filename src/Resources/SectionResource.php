<?php

namespace Tapp\FilamentSurvey\Resources;

use Filament\Actions\DeleteAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use LaraZeus\SpatieTranslatable\Resources\Concerns\Translatable;
use MattDaneshvar\Survey\Models\Section;
use Tapp\FilamentSurvey\Resources\SectionResource\Pages\CreateSection;
use Tapp\FilamentSurvey\Resources\SectionResource\Pages\EditSection;
use Tapp\FilamentSurvey\Resources\SectionResource\Pages\ListSections;

class SectionResource extends Resource
{
    use Translatable;

    protected static ?string $model = Section::class;

    public static function getNavigationIcon(): string
    {
        return config('filament-survey.navigation.section.icon');
    }

    public static function getNavigationSort(): ?int
    {
        return config('filament-survey.navigation.section.sort');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament-survey::filament-survey.navigation.group');
    }

    public static function getLabel(): string
    {
        return __('filament-survey::filament-survey.navigation.section.label');
    }

    public static function getPluralLabel(): string
    {
        return __('filament-survey::filament-survey.navigation.section.plural-label');
    }

    public static function getTranslatableLocales(): array
    {
        return array_keys(config('filament-survey.languages'));
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                Select::make('survey_id')
                    ->relationship('survey', 'name->en'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('survey.name'),
                TextColumn::make('name'),
                TextColumn::make('created_at')
                    ->dateTime(),
                TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            ->recordActions([
                DeleteAction::make(),
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
            'index' => ListSections::route('/'),
            'create' => CreateSection::route('/create'),
            'edit' => EditSection::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return true;
    }
}
