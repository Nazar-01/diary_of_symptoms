<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Symptom;
use App\Http\Services\SymptomsService;

class SymptomsController extends Controller
{

  public function __construct(SymptomsService $symptomsService)
  {
    $this->symptomsService = $symptomsService;
  }

  /**
  * Display a listing of the resource.
  */
  public function index()
  {
    $symptoms_array = $this->symptomsService->getSyptomsByDate(1);
    return view('pages.symptoms', ['symptoms_array' => $symptoms_array]);
  }

  /**
  * Show the form for creating a new resource.
  */
  public function create()
  {
    return view('pages.symptoms_add');
  }

  /**
  * Store a newly created resource in storage.
  */
  public function store(Request $request)
  {
    $symptom = $this->symptomsService->generateData($request);
    Symptom::create($symptom);
    return redirect()->route('symptoms.create')->with('success', 'Запись сохранена!');
  }

  /**
  * Display the specified resource.
  */
  public function show(string $id)
  {
    $symptom = Symptom::findOrFail($id);
    return view('pages.symptoms_edit', ['symptom' => $symptom]);
  }

  /**
  * Update the specified resource in storage.
  */
  public function update(Request $request, string $id)
  {

    $user = Symptom::findOrFail($id);
    $user->update($request->all());

    return redirect()->route('symptoms.show', $id)->with('success', 'Запись сохранена!');
  }

  /**
  * Remove the specified resource from storage.
  */
  public function destroy(string $id)
  {
    $symptom = Symptom::findOrFail($id);
    $symptom->delete();

    return redirect()->route('symptoms.index')->with('success', 'Запись удалена!');
  }

}
