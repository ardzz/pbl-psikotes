<?php

namespace App\Filament\Doctor\Widgets;

use App\Models\ExamResult;
use Filament\Widgets\ChartWidget;
use Illuminate\Database\Eloquent\Model;

class Validity extends ChartWidget
{
    protected static ?string $heading = 'Validity';

    public ?Model $record;

    protected function getData(): array
    {
        $sub_categories = [
            'VRIN', 'TRIN', 'F', 'Fb', 'Fp', 'L', 'K', 'S'
        ];

        $exam_result = ExamResult::where('exam_id', $this->record->id)->get();
        $collection = collect($sub_categories);
        $data = $collection->map(function ($item, $key) use ($exam_result) {
            $t_score = $exam_result->where('sub_category', $item)->first()->t_score;
            return $t_score == null ? 0 : ($t_score < 0 ? $t_score * -1 : $t_score);
        });

        return [
            'datasets' => [
                [
                    'data' => $data,
                    'backgroundColor' => '#36A2EB',
                    'borderColor' => '#9BD0F5',
                ],
            ],
            'labels' => $sub_categories,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    public static function canView(): bool
    {
        return request()->is('doctor/exams/*/analyze');
    }
}
