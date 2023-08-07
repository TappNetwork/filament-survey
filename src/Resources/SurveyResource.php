<?php

namespace Tapp\FilamentSurvey\Resources;

use Filament\Forms;
use Filament\Resources\Concerns\Translatable;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Enums\ActionsPosition;
use MattDaneshvar\Survey\Models\Survey;
use Tapp\FilamentSurvey\Resources\QuestionResource\Pages as QuestionPages;
use Tapp\FilamentSurvey\Resources\SurveyResource\Pages;
use Tapp\FilamentSurvey\Resources\SurveyResource\RelationManagers;
use Tapp\FilamentSurvey\Resources\SurveyResource\Widgets\Questions;

class SurveyResource extends Resource
{
    use Translatable;

    protected static ?string $model = Survey::class;

    public static function getNavigationIcon(): string
    {
        return config('filament-survey.navigation.survey.icon');
    }

    public static function getNavigationSort(): ?int
    {
        return config('filament-survey.navigation.survey.sort');
    }

    public static function getNavigationGroup(): ?string
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
            ->actions([
                Action::make('CreateQuestion')
                    ->url(fn (Survey $record): string => route('filament.admin.resources.surveys.create-question', $record->id))
                    ->color('success'),
            ], position: ActionsPosition::BeforeColumns)
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

    public static function getWidgets(): array
    {
        return [
            Questions::class,
        ];
    }
}
