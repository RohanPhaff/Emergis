<?php

namespace App\Http\Controllers;

use App\Charts\ProgramChart;
use App\Charts\CompletedProjectsChart;
use App\Charts\BudgetChart;
use App\Charts\DelayedProjectsChart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class DashboardController extends Controller
{
    public function index()
    {
        $bigChart = new ProgramChart;
        $smallChart1 = new CompletedProjectsChart;
        $smallChart2 = new BudgetChart;
        $smallChart3 = new DelayedProjectsChart;

        $labels = $bigChart->getLabels();

        $recentProjects = Project::orderBy('start_date', 'desc')
            ->take(3)
            ->get();

        return view('dashboard', compact('smallChart1', 'smallChart2', 'smallChart3', 'bigChart', 'labels', 'recentProjects'));
    }
}
