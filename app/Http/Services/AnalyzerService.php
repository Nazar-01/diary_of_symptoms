<?php

namespace App\Http\Services;

use App\Models\Symptom;
use Carbon\Carbon;

class AnalyzerService
{
  public function getAverageValue(array $data)
  {
    if (!$data) return 0;
    $counter = 0;
    foreach ($data as $key => $value) {
      $counter += $value['rating'];
    }
    $average_value = $counter / count($data);
    $average_value = round($average_value, 2);

    return $average_value;
  }

  public function calculationScoreForDay(array $array)
  {
    foreach ($array as $key => $value) {
      $average_value = $this->getAverageValue($value);
      $array[$key] = $average_value;
    }
    return $array;
  }

  public function getUnformattedData(int $days)
  {
    $start_date = Carbon::now()->subDays($days);
    $end_date = Carbon::now();
    $data = Symptom::where('user_id', auth()->id())
    ->whereDate('created_at', '>=', $start_date)
    ->whereDate('created_at', '<=', $end_date)
    ->orderBy('created_at', 'asc')
    ->get();
    return $data;
  }

  public function getDataForNumberDays(int $days)
  {
    $data = $this->getUnformattedData($days)
    ->groupBy(function($item) {
      return $item->created_at->format('d.m.Y');
    })
    ->toArray();
    return $data;
  }

  public function getDataForOneDay(int $days)
  {
    $data = $this->getUnformattedData($days)->toArray();
    $formattedData = [];
    foreach ($data as $item) {
      $createdAt = Carbon::parse($item['created_at'])->format('H:i:s');
      $formattedData[$createdAt] = $item['rating'];
    }
    return $formattedData;
  }

  public function getSingleArray(array $data)
  {
    if (!$data) return [];
    foreach ($data as $key => $value) {
      foreach ($value as $item) {
        $new_data[] = $item;
      }
    }
    return $new_data;
  }

  public function calculationColor()
  {
    $data = $this->getDataForNumberDays(6);
    $new_data = $this->getSingleArray($data);
    if (!$new_data) {
      return [
        'green' => '',
        'yellow' => '',
        'red' => '',
      ];
    };
    $green = 0;
    $yellow = 0;
    $red = 0;
    foreach ($new_data as $key => $value) {
      if ($value['rating'] <= 3) {
        ++$green;
      } elseif (3 < $value['rating'] and $value['rating'] <= 6) {
        ++$yellow;
      } else {
        ++$red;
      }
    }
    $total = $green + $yellow + $red;
    $green_percentage = ($green / $total) * 100;
    $yellow_percentage = ($yellow / $total) * 100;
    $red_percentage = ($red / $total) * 100;
    return [
      'green' => round($green_percentage, 2),
      'yellow' => round($yellow_percentage, 2),
      'red' => round($red_percentage, 2),
    ];
  }

}
