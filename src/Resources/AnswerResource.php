<?php

namespace Tapp\FilamentSurvey\Resources;

use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use MattDaneshvar\Survey\Models\Answer;
use Tapp\FilamentSurvey\Resources\AnswerResource\Pages;

class AnswerResource extends Resource
{
    protected static ?string $model = Answer::class;

    protected static function getNavigationIcon(): string
    {
        return config('filament-survey.navigation.answer.icon');
    }

    protected static function getNavigationSort(): ?int
    {
        return config('filament-survey.navigation.answer.sort');
    }

    protected static function getNavigationGroup(): ?string
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
                Tables\Columns\TextColumn::make('question.name'),
                Tables\Columns\TextColumn::make('entry.participant.name')
                    ->label(__('Participant')),
                Tables\Columns\TextColumn::make('value'),
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
            'index' => Pages\ListAnswers::route('/'),
            //'create' => Pages\CreateAnswer::route('/create'),
            //'edit' => Pages\EditAnswer::route('/{record}/edit'),
        ];
    }
}
