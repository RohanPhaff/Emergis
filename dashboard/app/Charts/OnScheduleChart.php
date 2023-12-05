<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use Illuminate\Support\Facades\DB;

class OnScheduleChart extends Chart
{
    protected $percentageOnSchedule;
    protected $totalProjects;
    protected $onScheduleCount;

    public function __construct()
    {
        parent::__construct();

        $statusData = DB::table('projects')->select('project_status')->whereIn('project_status', ['Op schema', 'Vertraagd'])->get();

        $statusCounts = $statusData->countBy('project_status')->toArray();

        $this->totalProjects = $statusData->count();

        $this->onScheduleCount = $statusCounts['Op schema'] ?? 0;
        $this->percentageOnSchedule = number_format(($this->onScheduleCount / $this->totalProjects) * 100, 1);

        $remainingPercentage = 100 - $this->percentageOnSchedule;

        $this->dataset('Delayed Projects Chart', 'doughnut', [$this->percentageOnSchedule, $remainingPercentage])
            ->backgroundColor(['#52C41A', '#FFF']);

        $this->labels(['Op schema', 'Overig']);

        $this->options([
            'cutoutPercentage' => 87,
            'legend' => [
                'display' => false,
            ],
            'responsive' => true,
            'maintainAspectRatio' => false,
            'tooltips' => [
                'enabled' => false,
            ],
            'elements' => [
                'arc' => [
                    'borderColor' => 'transparent',
                ],
            ],
        ]);

        $this->displayAxes(false);
    }

    public function getPercentageOnSchedule()
    {
        return $this->percentageOnSchedule;
    }

    public function getTotalProjects()
    {
        return $this->totalProjects;
    }

    public function getOnScheduleCount()
    {
        return $this->onScheduleCount;
    }
}
