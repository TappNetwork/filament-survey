<?php

namespace Tapp\FilamentSurvey\Resources\SectionResource\Pages;

use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Tapp\FilamentSurvey\Resources\SectionResource;

class ListSections extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = SectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('create')
                ->url(SectionResource::getUrl('create')),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
