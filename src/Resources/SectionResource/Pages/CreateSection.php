<?php

namespace Tapp\FilamentSurvey\Resources\SectionResource\Pages;

use LaraZeus\SpatieTranslatable\Resources\Pages\CreateRecord\Concerns\Translatable;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Tapp\FilamentSurvey\Resources\SectionResource;

class CreateSection extends CreateRecord
{
    use Translatable;

    protected static string $resource = SectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
        ];
    }
}
