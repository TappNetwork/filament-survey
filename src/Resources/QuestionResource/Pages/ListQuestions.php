<?php

namespace Tapp\FilamentSurvey\Resources\QuestionResource\Pages;

use LaraZeus\SpatieTranslatable\Resources\Pages\ListRecords\Concerns\Translatable;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Tapp\FilamentSurvey\Resources\QuestionResource;

class ListQuestions extends ListRecords
{
    use Translatable;

    protected static string $resource = QuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
        ];
    }
}
