<?php

namespace Tapp\FilamentSurvey\Resources\AnswerResource\Pages;

use Filament\Resources\Pages\ListRecords;
use Tapp\FilamentSurvey\Resources\AnswerResource;

class ListAnswers extends ListRecords
{
    protected static string $resource = AnswerResource::class;

    protected function getActions(): array
    {
        return [
            //
        ];
    }
}
