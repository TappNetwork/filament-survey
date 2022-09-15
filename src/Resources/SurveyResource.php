<?php

namespace Tapp\FilamentSurvey\Resources;

use Filament\Forms;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Actions\LinkAction;
use MattDaneshvar\Survey\Models\Survey;
use Tapp\FilamentAuditing\RelationManagers\AuditsRelationManager;
use Tapp\FilamentSurvey\Resources\QuestionResource\Pages as QuestionPages;
use Tapp\FilamentSurvey\Resources\SurveyResource\Pages;
use Tapp\FilamentSurvey\Resources\SurveyResource\RelationManagers;

class SurveyResource extends Resource
{
    use Translatable;

    protected static ?string $model = Survey::class;

    protected static function getNavigationIcon(): string
    {
        return config('filament-survey.navigation.survey.icon');
    }

    protected static function getNavigationSort(): ?int
    {
        return config('filament-survey.navigation.survey.sort');
    }

    protected static function getNavigationGroup(): ?string
    {
        return __('filament-survey::filament-survey.navigation.group');
    }

    public static function getLabel(): string
    {
        return __('filament-survey::filament-survey.navigation.survey.label');
    }

    public static function getPluralLabel(): string
    {
        return __('filament-survey::filament-survey.navigation.survey.plural-label');
    }

    public static function getTranslatableLocales(): array
    {
        return array_keys(config('filament-survey.languages'));
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required(),
                Forms\Components\TextInput::make('settings'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Name (English)'),
                Tables\Columns\TextColumn::make('name_en_es')
                    ->label(__('Name (En, Es)'))
                    ->formatStateUsing(fn (Survey $record): string => implode(', ', $record->getTranslations('name'))),
                Tables\Columns\TextColumn::make('settings'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            ->prependActions([
                LinkAction::make('CreateQuestion')
                    ->url(fn (Survey $record): string => route('filament.resources.surveys.create-question', $record->id))
                    ->color('success'),
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
            'index' => Pages\ListSurveys::route('/'),
            'create' => Pages\CreateSurvey::route('/create'),
            'create-question' => QuestionPages\CreateQuestion::route('/{survey_id}/create'),
            'edit' => Pages\EditSurvey::route('/{record}/edit'),
        ];
    }
}
