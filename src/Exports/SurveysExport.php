<?php

namespace Tapp\FilamentSurvey\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SurveysExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect(DB::select(DB::raw("
            SELECT
                users.name as user_name,
                users.email as user_email,
                JSON_EXTRACT(surveys.name, '$.en') as survey_name,
                JSON_EXTRACT(questions.content, '$.en') as question_content,
                JSON_EXTRACT(answers.value, '$.en') as answer_value,
                entries.created_at as entry_created_at
            FROM
                answers
                JOIN questions ON questions.id = answers.question_id
                JOIN entries ON entries.id = answers.entry_id
                JOIN surveys ON surveys.id = entries.survey_id
                JOIN users ON users.id = entries.participant_id
        ")));
    }

    public function map($survey): array
    {
        return [
            $survey->user_name,
            $survey->user_email,
            $survey->survey_name,
            $survey->question_content,
            $survey->answer_value,
            $survey->entry_created_at,
        ];
    }

    public function headings(): array
    {
        return [
            'user_name',
            'user_email',
            'survey_name',
            'question_content',
            'answer_value',
            'entry_created_at',
        ];
    }
}
