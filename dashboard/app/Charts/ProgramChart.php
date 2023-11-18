<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use Illuminate\Support\Facades\DB;

class ProgramChart extends Chart
{
    protected $labelsWithPercentage;

    public function __construct()
    {
        parent::__construct();

        $chartData = DB::table('projects')->select('Program')->get();

        $programCounts = $chartData->countBy('Program')->toArray();

        arsort($programCounts);

        $topPrograms = array_slice($programCounts, 0, 5);

        $totalCount = array_sum($programCounts);

        $programs = array_keys($topPrograms);
        $programs[] = 'Overig';

        $programCounts = collect($programs)->map(function ($program) use ($chartData, $totalCount, $topPrograms) {
            return $program === 'Overig' ? $totalCount - array_sum($topPrograms) : $chartData->where('Program', $program)->count();
        })->all();

        $this->labelsWithPercentage = collect($programs)->map(function ($program, $index) use ($programCounts, $totalCount) {
            $count = $programCounts[$index];
            $percentage = number_format(($count / $totalCount) * 100, 2);
            return "$program $percentage%";
        })->all();

        $this->labels($this->labelsWithPercentage)
            ->dataset('Program Chart', 'doughnut', $programCounts)
            ->backgroundColor(['#1890FF', '#13C2C2', '#52C41A', '#FADB14', '#FF4D4F', '#722ED1']);

        $this->options([
            'responsive' => true,
            'maintainAspectRatio' => false,
            'cutoutPercentage' => 80,
            'legend' => [
                'display' => false,
            ],
        ]);

        $this->displayAxes(false);
    }

    public function getLabels()
    {
        return $this->labelsWithPercentage;
    }
}
