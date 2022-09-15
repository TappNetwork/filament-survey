<?php

return [

    'resources' => [
        'AnswerResource' => \Tapp\FilamentSurvey\Resources\AnswerResource::class,
        'EntryResource' => \Tapp\FilamentSurvey\Resources\EntryResource::class,
        'QuestionResource' => \Tapp\FilamentSurvey\Resources\QuestionResource::class,
        'SectionResource' => \Tapp\FilamentSurvey\Resources\SectionResource::class,
        'SurveyResource' => \Tapp\FilamentSurvey\Resources\SurveyResource::class,
    ],

    'languages' => [
        'en' => 'English',
        'es' => 'Spanish',
    ],

    'navigation' => [
        'answer' => [
            'sort' => 4,
            'icon' => 'heroicon-o-reply',
        ],
        'entry' => [
            'sort' => 5,
            'icon' => 'heroicon-o-view-list',
        ],
        'question' => [
            'sort' => 3,
            'icon' => 'heroicon-o-question-mark-circle',
        ],
        'section' => [
            'sort' => 2,
            'icon' => 'heroicon-o-folder-open',
        ],
        'survey' => [
            'sort' => 1,
            'icon' => 'heroicon-o-collection',
        ],
    ],

];
