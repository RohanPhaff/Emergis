<?php

namespace App\Http\Controllers;

use App\Charts\CompletedProjectsChart;
use App\Charts\BudgetChart;
use App\Charts\DelayedProjectsChart;
use App\Charts\DepartmentChart;
use App\Charts\OnScheduleChart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class DashboardController extends Controller
{
    public function index()
    {
        $bigChart = new DepartmentChart;
        $completedProjectsChart = new CompletedProjectsChart;
        $budgetChart = new BudgetChart;
        $delayedProjectsChart = new DelayedProjectsChart;
        $onScheduleChart = new OnScheduleChart;

        $labels = $bigChart->getLabels();

        $recentProjects = Project::where('start_date', '<=', date('Y-m-d'))
            ->orderByRaw('ABS(DATEDIFF(start_date, CURDATE()))')
            ->take(3)
            ->get();

        return view('dashboard', compact('completedProjectsChart', 'budgetChart', 'delayedProjectsChart', 'onScheduleChart', 'bigChart', 'labels', 'recentProjects'));
    }
}
