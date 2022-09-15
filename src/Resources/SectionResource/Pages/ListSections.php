<?php

namespace Tapp\FilamentSurvey\Resources\SectionResource\Pages;

use Filament\Resources\Pages\ListRecords;
use Tapp\FilamentSurvey\Resources\SectionResource;

class ListSections extends ListRecords
{
    use ListRecords\Concerns\Translatable;
    
    protected static string $resource = SectionResource::class;
}
