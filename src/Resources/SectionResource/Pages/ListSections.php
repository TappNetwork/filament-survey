<?php

namespace Tapp\FilamentSurvey\Resources\SectionResource\Pages;

use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;
use LaraZeus\SpatieTranslatable\Resources\Pages\ListRecords\Concerns\Translatable;
use Tapp\FilamentSurvey\Resources\SectionResource;

class ListSections extends ListRecords
{
    use Translatable;

    protected static string $resource = SectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('create')
                ->url(SectionResource::getUrl('create')),
            LocaleSwitcher::make(),
        ];
    }
}
