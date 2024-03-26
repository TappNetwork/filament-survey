<?php

return [

    'resources' => [
        'AnswerResource' => \Tapp\FilamentSurvey\Resources\AnswerResource::class,
        'EntryResource' => \Tapp\FilamentSurvey\Resources\EntryResource::class,
        'SurveyResource' => \Tapp\FilamentSurvey\Resources\SurveyResource::class,
    ],

    'languages' => [
        'en' => 'English',
        'es' => 'Spanish',
    ],

    'navigation' => [
        'answer' => [
            'sort' => 4,
            'icon' => 'heroicon-o-arrow-uturn-left',
        ],
        'entry' => [
            'sort' => 5,
            'icon' => 'heroicon-o-bars-4',
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
            'icon' => 'heroicon-o-rectangle-stack',
        ],
    ],

    'actions' => [
        'survey' => [
            'export' => [
                'icon' => 'heroicon-s-arrow-down-tray',
            ],
        ],
    ],

    'question' => [
        'types' => [
            'text' => 'Text',
            'number' => 'Number',
            'radio' => 'Radio',
            'multiselect' => 'Multiselect',
        ],
    ],

];
