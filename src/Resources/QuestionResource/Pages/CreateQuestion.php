<?php

namespace Tapp\FilamentSurvey\Resources\QuestionResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Tapp\FilamentSurvey\Resources\QuestionResource;

class CreateQuestion extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

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
            Actions\LocaleSwitcher::make(),
        ];
    }
}
