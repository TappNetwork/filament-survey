<?php

namespace Tapp\FilamentSurvey\Resources;

use LaraZeus\SpatieTranslatable\Resources\Concerns\Translatable;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Checkbox;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\DeleteAction;
use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Tapp\FilamentSurvey\Resources\SurveyResource\Pages\ListSurveys;
use Tapp\FilamentSurvey\Resources\SurveyResource\Pages\CreateSurvey;
use Tapp\FilamentSurvey\Resources\SurveyResource\Pages\EditSurvey;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;
use MattDaneshvar\Survey\Models\Survey;
use Tapp\FilamentSurvey\Jobs\SendExportSurveys;
use Tapp\FilamentSurvey\Resources\SurveyResource\Pages;
use Tapp\FilamentSurvey\Resources\SurveyResource\RelationManagers\QuestionsRelationManager;
use Tapp\FilamentSurvey\Resources\SurveyResource\RelationManagers\SectionsRelationManager;

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

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                Checkbox::make('limit')
                    ->label('Limit entries per participant?')
                    ->live()
                    ->inline(false),
                TextInput::make('limit_per_participant')
                    ->default(1)
                    ->visible(function (Get $get) {
                        return $get('limit');
                    })
                    ->minValue(1)
                    ->numeric(),
                Checkbox::make('allow_guests')
                    ->label('Allow guest users to respond to survey?')
                    ->inline(false),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Name (English)')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime(),
                TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            ->recordActions([
                DeleteAction::make(),
                Action::make(__('Export Answers'))
                    ->icon(config('filament-survey.actions.survey.export.icon'))
                    ->action(function (Survey $record) {
                        SendExportSurveys::dispatch(user: request()->user(), survey: $record);

                        Notification::make()
                            ->title(__('You will receive your export via email'))
                            ->success()
                            ->send();
                    }),
            ])
            ->toolbarActions([
                BulkAction::make('Export Answers')
                    ->icon(config('filament-survey.actions.survey.export.icon'))
                    ->action(function (Collection $records) {
                        SendExportSurveys::dispatch(user: request()->user(), surveys: $records);

                        Notification::make()
                            ->title(__('You will receive your export via email'))
                            ->success()
                            ->send();
                    }),
            ])
            ->filters([
                //
            ]);
    }

    public function export(Survey $survey)
    {
        SendExportSurveys::dispatch(user: request()->user(), survey: $survey);

        Notification::make()
            ->title(__('You will receive your export via email'))
            ->success()
            ->send();
    }

    public function exportBulk(Collection $surveys)
    {
        SendExportSurveys::dispatch(user: request()->user(), surveys: $surveys);

        Notification::make()
            ->title(__('You will receive your export via email'))
            ->success()
            ->send();
    }

    public static function getRelations(): array
    {
        return [
            SectionsRelationManager::class,
            QuestionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSurveys::route('/'),
            'create' => CreateSurvey::route('/create'),
            'edit' => EditSurvey::route('/{record}/edit'),
        ];
    }
}
