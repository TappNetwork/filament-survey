<?php

namespace Tapp\FilamentSurvey\Resources\SurveyResource\RelationManagers;

use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use LaraZeus\SpatieTranslatable\Resources\RelationManagers\Concerns\Translatable;
use MattDaneshvar\Survey\Models\Section;

class QuestionsRelationManager extends RelationManager
{
    use Translatable;

    public static function getTranslatableLocales(): array
    {
        return array_keys(config('filament-survey.languages'));
    }

    protected static string $relationship = 'questions';

    public function form(Schema $schema): Schema
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
                    ->options(fn () => Section::where('survey_id', $this->getOwnerRecord()->id)->pluck('name', 'id')),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                CreateAction::make(),
            ])
            ->columns([
                TextColumn::make('content')
                    ->label('Question')
                    ->toggleable(),
                TextColumn::make('type')
                    ->toggleable(),
                TextColumn::make('order')
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('section.name'),
                TextColumn::make('created_at')
                    ->toggleable()
                    ->dateTime(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->defaultSort('order')
            ->reorderable('order');
    }
}
