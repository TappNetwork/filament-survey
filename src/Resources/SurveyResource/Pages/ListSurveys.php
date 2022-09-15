<?php

namespace Tapp\FilamentSurvey\Resources\SurveyResource\Pages;

use Tapp\FilamentSurvey\Jobs\SendExportSurveys;
use Filament\Notifications\Notification;
use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Tapp\FilamentSurvey\Resources\SurveyResource;

class ListSurveys extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = SurveyResource::class;

    protected function getActions(): array
    {
        return [
            Action::make(__('Export Answers'))
                ->icon('heroicon-s-download')
                ->action('export'),
        ];
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
}
