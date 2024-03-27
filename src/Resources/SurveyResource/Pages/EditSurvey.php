<?php

namespace Tapp\FilamentSurvey\Resources\SurveyResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Tapp\FilamentSurvey\Resources\SurveyResource;

class EditSurvey extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = SurveyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $settings = $this->record->settings;

        if ($settings) {
            $data['limit'] = $settings['limit-per-participant'] > 0;
            $data['limit_per_participant'] = $settings['limit-per-participant'] ?? null;
            $data['allow_guests'] = $settings['accept-guest-entries'];
        }

        $data['name'] = $this->record->name;

        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $settings = [
            'accept-guest-entries' => $data['allow_guests'],
            'limit-per-participant' => ! $data['limit'] ? -1 : $data['limit_per_participant'],
        ];

        $record->update([
            'name' => $data['name'],
            'settings' => $settings,
        ]);

        return $record;
    }
}
