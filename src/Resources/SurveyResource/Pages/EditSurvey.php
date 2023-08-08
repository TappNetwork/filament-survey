<?php

namespace Tapp\FilamentSurvey\Resources\SurveyResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Tapp\FilamentSurvey\Resources\SurveyResource;

class EditSurvey extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = SurveyResource::class;

    protected function getFooterWidgets(): array
    {
        return [
            SurveyResource\Widgets\Questions::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
