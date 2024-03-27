<?php

namespace Tapp\FilamentSurvey\Resources\SurveyResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Tapp\FilamentSurvey\Resources\SurveyResource;

class CreateSurvey extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = SurveyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }

    protected function handleRecordCreation(array $data): Model
    {
        $settings = [
            'accept-guest-entries' => $data['allow_guests'],
            'limit-per-participant' => ! $data['limit'] ? -1 : $data['limit_per_participant'],
        ];

        return static::getModel()::create([
            'name' => $data['name'],
            'settings' => $settings,
        ]);
    }
}
