<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use App\Models\AgriculturalMachine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RentalController extends Controller
{
    public function index()
    {
        return Rental::with('machine')->get();
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'rental_start' => 'required|date',
            'rental_end' => 'required|date|after:rental_start',
            'machine_id' => 'required|exists:agricultural_machines,id',
        ]);

        $machine = AgriculturalMachine::findOrFail($validatedData['machine_id']);

        $conflictingRentals = $machine->rentals()
            ->where(function ($query) use ($validatedData) {
                $query->whereBetween('rental_start', [$validatedData['rental_start'], $validatedData['rental_end']])
                    ->orWhereBetween('rental_end', [$validatedData['rental_start'], $validatedData['rental_end']])
                    ->orWhere(function ($query) use ($validatedData) {
                        $query->where('rental_start', '<=', $validatedData['rental_start'])
                            ->where('rental_end', '>=', $validatedData['rental_end']);
                    });
            })
            ->exists();

        if ($conflictingRentals) {
            return response()->json(['error' => 'A gép már ki van kölcsönözve ebben az időszakban.'], 422);
        }

        return Rental::create($validatedData);
    }

    public function show($id)
    {
        try {
            $rental = Rental::with('machine')->findOrFail($id);
            return response()->json($rental, 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'error' => 'A keresett kölcsönzés nem található.',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Hiba történt: ' . $e->getMessage(),
            ], 500);
        }
    }    

    public function destroy($id)
    {
        try {
            $rental = Rental::findOrFail($id);
            $rental->delete();
            return response()->json(null, 204);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'error' => 'A törölni kívánt kölcsönzés nem található.',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Hiba történt a kölcsönzés törlése közben: ' . $e->getMessage(),
            ], 500);
        }
    }
    
}