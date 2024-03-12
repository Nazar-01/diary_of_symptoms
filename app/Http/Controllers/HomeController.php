<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
  public function __construct(AnalyzerController $analyzerController)
  {
    $this->analyzerController = $analyzerController;
  }

  public function index()
  {
    $data_index = $this->analyzerController->getStressIndex();
    $data_day = $this->analyzerController->formationCurrentDailyArray();
    $data_mounth = $this->analyzerController->formationCurrentMonthlyArray();
    $data_colors = $this->analyzerController->getColors();
    
    return view('pages.main_page', [
      'data_index' => $data_index,
      'data_day' => $data_day,
      'data_mounth' => $data_mounth,
      'data_colors' => $data_colors,
    ]);
  }
}
