<?php

namespace Tapp\FilamentSurvey\Resources;

use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use MattDaneshvar\Survey\Models\Answer;
use Tapp\FilamentSurvey\Resources\AnswerResource\Pages;
use Tapp\FilamentSurvey\Resources\AnswerResource\Pages\ListAnswers;

class AnswerResource extends Resource
{
    protected static ?string $model = Answer::class;

    public static function getNavigationIcon(): string
    {
        return config('filament-survey.navigation.answer.icon');
    }

    public static function getNavigationSort(): ?int
    {
        return config('filament-survey.navigation.answer.sort');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament-survey::filament-survey.navigation.group');
    }

    public static function getLabel(): string
    {
        return __('filament-survey::filament-survey.navigation.answer.label');
    }

    public static function getPluralLabel(): string
    {
        return __('filament-survey::filament-survey.navigation.answer.plural-label');
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
                TextColumn::make('question.name'),
                TextColumn::make('entry.participant.name')
                    ->label(__('Participant')),
                TextColumn::make('value'),
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
            'index' => ListAnswers::route('/'),
            // 'create' => Pages\CreateAnswer::route('/create'),
            // 'edit' => Pages\EditAnswer::route('/{record}/edit'),
        ];
    }
}
