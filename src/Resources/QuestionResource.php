<?php

namespace Tapp\FilamentSurvey\Resources;

use LaraZeus\SpatieTranslatable\Resources\Concerns\Translatable;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TagsColumn;
use Filament\Actions\DeleteAction;
use Tapp\FilamentSurvey\Resources\QuestionResource\Pages\ListQuestions;
use Tapp\FilamentSurvey\Resources\QuestionResource\Pages\CreateQuestion;
use Tapp\FilamentSurvey\Resources\QuestionResource\Pages\EditQuestion;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component as Livewire;
use MattDaneshvar\Survey\Models\Question;
use MattDaneshvar\Survey\Models\Section;
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

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('content')
                    ->label('Question')
                    ->required(),
                Select::make('type')
                    ->required()
                    ->reactive()
                    ->options(config('filament-survey.question.types')),
                TagsInput::make('options')
                    ->placeholder('New option')
                    ->helperText('Used for radio and multiselect types. Press enter after each option')
                    ->required(fn (Get $get) => $get('type') == 'radio' || $get('type') == 'multiselect')
                    ->visible(fn (Get $get) => $get('type') == 'radio' || $get('type') == 'multiselect'),
                TagsInput::make('rules')
                    ->placeholder('New rule')
                    ->helperText("Validation rules. Eg: 'numeric', 'min:2', 'required'. Press Enter after each rule. see https://laravel.com/docs/11.x/validation#available-validation-rules for a full list of available rules"),
                Select::make('section_id')->label('Section')
                    ->options(fn (Livewire $livewire, ?Model $record) => ! empty($livewire->survey_id) ? Section::where('survey_id', $livewire->survey_id)->pluck('name', 'id') : ($record ? Section::where('id', $record->section_id)->pluck('name', 'id') : []))
                    ->helperText('To be available here, a survey should be added first on section.'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('survey.name')
                    ->sortable(),
                TextColumn::make('section.name'),
                TextColumn::make('content'),
                TextColumn::make('type'),
                TextColumn::make('order'),
                TagsColumn::make('options'),
                TagsColumn::make('rules'),
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
            'index' => ListQuestions::route('/'),
            'create' => CreateQuestion::route('/create'),
            'edit' => EditQuestion::route('/{record}/edit'),
        ];
    }
}
