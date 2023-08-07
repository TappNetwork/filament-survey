<?php

namespace Tapp\FilamentSurvey\Resources;

use Filament\Forms;
use Filament\Resources\Concerns\Translatable;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component as Livewire;
use MattDaneshvar\Survey\Models\Question;
use MattDaneshvar\Survey\Models\Section;
use MattDaneshvar\Survey\Models\Survey;
use Tapp\FilamentSurvey\Resources\QuestionResource\Pages;

class QuestionResource extends Resource
{
    use Translatable;

    protected static ?string $model = Question::class;

    public static function getNavigationIcon(): string
    {
        return config('filament-survey.navigation.question.icon');
    }

    public static function getNavigationSort(): ?int
    {
        return config('filament-survey.navigation.question.sort');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament-survey::filament-survey.navigation.group');
    }

    public static function getLabel(): string
    {
        return __('filament-survey::filament-survey.navigation.question.label');
    }

    public static function getPluralLabel(): string
    {
        return __('filament-survey::filament-survey.navigation.question.plural-label');
    }

    public static function getTranslatableLocales(): array
    {
        return array_keys(config('filament-survey.languages'));
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('content')
                    ->required(),
                Forms\Components\Select::make('type')
                    ->required()
                    ->reactive()
                    ->options(config('filament-survey.question.types')),
                Forms\Components\TextInput::make('order')
                    ->numeric()
                    ->required(),
                Forms\Components\TagsInput::make('options')
                    ->placeholder('New option')
                    ->helperText("Used for radio and multiselect types. Eg: ['Yes', 'No']")
                    ->visible(fn (Get $get) => $get('type') == 'radio' || $get('type') == 'multiselect'),
                Forms\Components\TagsInput::make('rules')
                    ->placeholder('New rule')
                    ->helperText("Validation rules. Eg: ['numeric', 'min:2', 'required']"),
                Forms\Components\Select::make('section_id')->label('Section')
                    ->options(fn (Livewire $livewire, ?Model $record) => ! empty($livewire->survey_id) ? Section::where('survey_id', $livewire->survey_id)->pluck('name', 'id') : ($record ? Section::where('id', $record->section_id)->pluck('name', 'id') : []))
                    ->helperText('To be available here, a survey should be added first on section.'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('survey.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('section.name'),
                Tables\Columns\TextColumn::make('content'),
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\TextColumn::make('order'),
                Tables\Columns\TagsColumn::make('options'),
                Tables\Columns\TagsColumn::make('rules'),
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
            'index' => Pages\ListQuestions::route('/'),
            'create' => Pages\CreateQuestion::route('/create'),
            'edit' => Pages\EditQuestion::route('/{record}/edit'),
        ];
    }
}
