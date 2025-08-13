<?php

namespace Tapp\FilamentSurvey\Resources\QuestionResource\Pages;

use Filament\Resources\Pages\EditRecord;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;
use LaraZeus\SpatieTranslatable\Resources\Pages\EditRecord\Concerns\Translatable;
use Tapp\FilamentSurvey\Resources\QuestionResource;

class EditQuestion extends EditRecord
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
