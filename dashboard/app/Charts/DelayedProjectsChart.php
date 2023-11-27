<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use Illuminate\Support\Facades\DB;

class DelayedProjectsChart extends Chart
{
    protected $percentageDelayed;
    protected $totalProjects;
    protected $delayedCount;

    public function __construct()
    {
        parent::__construct();

        $statusData = DB::table('projects')->select('project_status')->whereIn('project_status', ['Op schema', 'Vertraagd'])->get();

        $statusCounts = $statusData->countBy('project_status')->toArray();

        $this->totalProjects = $statusData->count();

        $this->delayedCount = $statusCounts['Vertraagd'] ?? 0;
        $this->percentageDelayed = number_format(($this->delayedCount / $this->totalProjects) * 100, 1);

        $remainingPercentage = 100 - $this->percentageDelayed;

        $this->dataset('Delayed Projects Chart', 'doughnut', [$this->percentageDelayed, $remainingPercentage])
            ->backgroundColor(['#FF4D4F', '#FFF']);

        $this->labels(['Vertraagd', 'Overig']);

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

    public function getPercentageDelayed()
    {
        return $this->percentageDelayed;
    }

    public function getTotalProjects()
    {
        return $this->totalProjects;
    }

    public function getDelayedCount()
    {
        return $this->delayedCount;
    }
}
