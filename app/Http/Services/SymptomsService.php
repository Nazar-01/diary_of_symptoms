<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\Symptom;
use Illuminate\Support\Facades\Auth;

class SymptomsService
{
  public function getSyptomsByDate($page)
  {
    $data = Symptom::where('user_id', auth()->id())
    ->orderBy('created_at', 'desc')
    ->paginate(20)
    ->groupBy(function($item) {
        return $item->created_at->format('d.m.Y');
    })
    ->toArray();

    return $data;
  }

  public function loadMoreData(Request $request)
  {
    $page = $request->input('page');
    $data = $this->getSyptomsByDate($page);
    return response()->json(['data' => $data], 200, [], JSON_UNESCAPED_UNICODE);
  }

  public function generateData(Request $request)
  {
    $validatedData = $request->validate([
      'name' => 'required|string|max:255',
    ], [
      'name.required' => 'Поле "Имя" обязательно для заполнения.',
    ]);

    $symptom = $request->all();
    $symptom['user_id'] = auth()->id();

    return $symptom;
  }

}
