<?php

namespace Tapp\FilamentSurvey\Resources\SectionResource\Pages;

use Filament\Resources\Pages\EditRecord;
use Tapp\FilamentSurvey\Resources\SectionResource;

class EditSection extends EditRecord
{
    use EditRecord\Concerns\Translatable;
    
    protected static string $resource = SectionResource::class;
}
