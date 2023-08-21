<?php

namespace Tapp\FilamentSurvey\Resources\SurveyResource\Pages;

use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Tapp\FilamentSurvey\Jobs\SendExportSurveys;
use Tapp\FilamentSurvey\Resources\SurveyResource;

class ListSurveys extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = SurveyResource::class;

    protected function getActions(): array
    {
        $actions = parent::getActions();

        return array_merge($actions, [
            Action::make(__('Export Answers'))
                ->icon(config('filament-survey.actions.survey.export.icon'))
                ->action('export'),
        ]);
    }

    public function export()
    {
        SendExportSurveys::dispatch(request()->user());

        Notification::make()
            ->title(__('You will receive your export via email'))
            ->success()
            ->send();
    }

    protected function getFooterWidgets(): array
    {
        return [
            //
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('create')
                ->url(SurveyResource::getUrl('create')),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
