<?php

namespace Tapp\FilamentSurvey\Resources\QuestionResource\Pages;

use Filament\Resources\Pages\ListRecords;
use Tapp\FilamentSurvey\Resources\QuestionResource;

class ListQuestions extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = QuestionResource::class;

    protected function getActions(): array
    {
        return [
            //
        ];
    }
}
