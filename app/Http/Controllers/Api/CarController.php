<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
  public function __construct()
  {
    $this->authorizeResource(Car::class, 'car');
  }

  public function index()
  {
    $cars = Car::all();
    return response()->json($cars);
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'brand' => 'required|string|max:255',
      'model' => 'required|string|max:255',
      'price' => 'required|numeric|min:0',
    ]);

    $car = Car::create($validated);
    return response()->json($car, 201);
  }

  public function show(Car $car)
  {
    return response()->json($car);
  }

  public function update(Request $request, Car $car)
  {
    $validated = $request->validate([
      'brand' => 'sometimes|required|string|max:255',
      'model' => 'sometimes|required|string|max:255',
      'price' => 'sometimes|required|numeric|min:0',
    ]);

    $car->update($validated);
    return response()->json($car);
  }

  public function destroy(Car $car)
  {
    $car->delete();
    return response()->json(null, 204);
  }
}
