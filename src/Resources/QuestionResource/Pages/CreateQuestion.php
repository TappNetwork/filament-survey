<?php

namespace Tapp\FilamentSurvey\Resources\QuestionResource\Pages;

use LaraZeus\SpatieTranslatable\Resources\Pages\CreateRecord\Concerns\Translatable;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Tapp\FilamentSurvey\Resources\QuestionResource;

class CreateQuestion extends CreateRecord
{
    use Translatable;

    protected static string $resource = QuestionResource::class;

    public $survey_id;

    public function mutateFormDataBeforeCreate(array $data): array
    {
        $data['survey_id'] = $this->survey_id;

        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
        ];
    }
}
