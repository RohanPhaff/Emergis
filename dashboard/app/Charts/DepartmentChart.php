<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use Illuminate\Support\Facades\DB;

class DepartmentChart extends Chart
{
    protected $labelsWithPercentage;

    public function __construct()
    {
        parent::__construct();

        $chartData = DB::table('projects')->select('department')->get();

        $departmentCounts = $chartData->countBy('department')->toArray();

        arsort($departmentCounts);

        $topdepartments = array_slice($departmentCounts, 0, 5);

        $totalCount = array_sum($departmentCounts);

        $departments = array_keys($topdepartments);
        $departments[] = 'Overig';

        $departmentCounts = collect($departments)->map(function ($department) use ($chartData, $totalCount, $topdepartments) {
            return $department === 'Overig' ? $totalCount - array_sum($topdepartments) : $chartData->where('department', $department)->count();
        })->all();

        $this->labelsWithPercentage = collect($departments)->map(function ($department, $index) use ($departmentCounts, $totalCount) {
            $count = $departmentCounts[$index];
            $percentage = number_format(($count / $totalCount) * 100, 2);
            return "$department $percentage%";
        })->all();

        $this->labels($this->labelsWithPercentage)
            ->dataset('Department Chart', 'doughnut', $departmentCounts)
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
