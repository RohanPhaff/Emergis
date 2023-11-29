<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use Illuminate\Support\Facades\DB;

class CompletedProjectsChart extends Chart
{
    protected $completedProjectsCount;
    protected $totalProjectsCount;
    protected $percentageCompleted;

    public function __construct()
    {
        parent::__construct();

        $this->completedProjectsCount = DB::table('projects')->where('progress', 100)->count();
        $this->totalProjectsCount = DB::table('projects')->count();

        $this->percentageCompleted = ($this->completedProjectsCount / $this->totalProjectsCount) * 100;
        $percentageRemaining = 100 - $this->percentageCompleted;

        $this->dataset('Completed Projects Chart', 'doughnut', [$this->percentageCompleted, $percentageRemaining])
            ->backgroundColor(['#FAAD14', '#FFF']);

        $this->labels(['Afgerond', 'Overig']);

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

    public function getCompletedProjectsCount()
    {
        return $this->completedProjectsCount;
    }

    public function getTotalProjectsCount()
    {
        return $this->totalProjectsCount;
    }

    public function getPercentageCompleted()
    {
        return $this->percentageCompleted;
    }
}
