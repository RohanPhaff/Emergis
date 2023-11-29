<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use Illuminate\Support\Facades\DB;

class BudgetChart extends Chart
{
    protected $percentageExpectedCosts;
    protected $totalBudget;
    protected $totalExpectedCosts;

    public function __construct()
    {
        parent::__construct();

        $budgetData = DB::table('projects')->select('budget', 'spent_costs')->get();

        $this->totalBudget = $budgetData->sum('budget');
        $this->totalExpectedCosts = $budgetData->sum('spent_costs');

        $this->percentageExpectedCosts = number_format(($this->totalExpectedCosts / $this->totalBudget) * 100, 1);
        $percentageRemaining = 100 - $this->percentageExpectedCosts;

        $this->dataset('Budget Chart', 'doughnut', [$this->percentageExpectedCosts, $percentageRemaining])
            ->backgroundColor(['#52C41A', '#FFF']);

        $this->labels(['Kosten', 'Overig']);

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

    public function getPercentageExpectedCosts()
    {
        return $this->percentageExpectedCosts;
    }

    public function getTotalBudget()
    {
        return $this->totalBudget;
    }

    public function getTotalExpectedCosts()
    {
        return $this->totalExpectedCosts;
    }
}
