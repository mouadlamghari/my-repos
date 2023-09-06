<?php

namespace App\Charts;

use App\Models\Consultation;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class ConsultationChart extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $consultationsByMonth = Consultation::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
        ->groupBy('month')
        ->orderBy('month')
        ->get();

    // Extract the month and consultation count from the result
    $months = $consultationsByMonth->pluck('month');
    $counts = $consultationsByMonth->pluck('count');

    // Set the chart type and data
    $this->type('bar');
    $this->labels($months);
    $this->dataset('Consultations by Month', 'bar', $counts)
        ->color('rgba(75, 192, 192, 0.2)')
        ->backgroundcolor('rgba(75, 192, 192, 1)');
    }
}
