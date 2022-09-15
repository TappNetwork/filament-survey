<?php

namespace Tapp\FilamentSurvey\Resources\QuestionResource\Pages;

use Filament\Resources\Pages\EditRecord;
use Tapp\FilamentSurvey\Resources\QuestionResource;

class EditQuestion extends EditRecord
{
    use EditRecord\Concerns\Translatable;
    
    protected static string $resource = QuestionResource::class;
}
