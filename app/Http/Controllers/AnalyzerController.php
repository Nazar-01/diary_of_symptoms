<?php

namespace App\Http\Controllers;

use App\Models\Symptom;
use App\Http\Services\AnalyzerService;

class AnalyzerController extends Controller
{

  public function __construct(AnalyzerService $analyzerService)
  {
    $this->analyzerService = $analyzerService;
  }

  public function getStressIndex()
  {
    $data = $this->analyzerService->getDataForNumberDays(6);
    $new_data = $this->analyzerService->getSingleArray($data);
    $average_value = $this->analyzerService->getAverageValue($new_data);
    return $average_value;
  }

  public function formationCurrentDailyArray()
  {
    $data = $this->analyzerService->getDataForOneDay(0);
    return $data;
  }

  public function formationCurrentMonthlyArray()
  {
    $data = $this->analyzerService->getDataForNumberDays(30);
    $average_value = $this->analyzerService->calculationScoreForDay($data);
    return $average_value;
  }

  public function getColors()
  {
    $colors = $this->analyzerService->calculationColor();
    return $colors;
  }
}
