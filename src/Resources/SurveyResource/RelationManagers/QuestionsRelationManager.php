<?php

namespace Tapp\FilamentSurvey\Resources\SurveyResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Livewire\Component as Livewire;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\RelationManagers\Concerns\Translatable;
use MattDaneshvar\Survey\Models\Question;
use MattDaneshvar\Survey\Models\Section;

class QuestionsRelationManager extends RelationManager
{
    use Translatable;

    public static function getTranslatableLocales(): array
    {
        return array_keys(config('filament-survey.languages'));
    }

    protected static string $relationship = 'questions';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('content')
                    ->label('Question')
                    ->required(),
                Forms\Components\Select::make('type')
                    ->required()
                    ->reactive()
                    ->options(config('filament-survey.question.types')),
                Forms\Components\TagsInput::make('options')
                    ->placeholder('New option')
                    ->helperText("Used for radio and multiselect types. Press enter after each option")
                    ->required(fn (Get $get) => $get('type') == 'radio' || $get('type') == 'multiselect')
                    ->visible(fn (Get $get) => $get('type') == 'radio' || $get('type') == 'multiselect'),
                Forms\Components\TagsInput::make('rules')
                    ->placeholder('New rule')
                    ->helperText("Validation rules. Eg: 'numeric', 'min:2', 'required'. Press Enter after each rule. see https://laravel.com/docs/11.x/validation#available-validation-rules for a full list of available rules"),
                Forms\Components\Select::make('section_id')->label('Section')
                    ->options(fn () => Section::where('survey_id', $this->getOwnerRecord()->id)->pluck('name', 'id'))
                    ->helperText('To be available here, a survey should be added first on section.'),
            ]);
    }
 
    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                CreateAction::make(),
            ])
            ->columns([
                Tables\Columns\TextColumn::make('content')
                    ->label('Question')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('type')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('order')
                    ->toggleable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('section.name'),
                Tables\Columns\TextColumn::make('created_at')
                    ->toggleable()
                    ->dateTime(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->defaultSort('order')
            ->reorderable('order');
    }
}
