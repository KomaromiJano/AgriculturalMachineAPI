<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\AgriculturalMachine;
use Illuminate\Http\Request;

class AgriculturalMachineController extends Controller
{
    public function index()
    {
        return AgriculturalMachine::with('rentals')->get();
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'license_plate' => 'required|string|unique:agricultural_machines',
            'daily_price' => 'required|numeric|min:0',
        ]);

        return AgriculturalMachine::create($validatedData);
    }

    public function show($id)
    {
        try {
            $machine = AgriculturalMachine::with('rentals')->findOrFail($id);
            return response()->json($machine, 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'error' => 'A keresett mezőgazdasági gép nem található.',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Hiba történt: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $machine = AgriculturalMachine::findOrFail($id);
    
            $validatedData = $request->validate([
                'name' => 'sometimes|required|string',
                'license_plate' => 'sometimes|required|string|unique:agricultural_machines,license_plate,' . $id,
                'daily_price' => 'sometimes|required|numeric|min:0',
            ]);
    
            $machine->update($validatedData);
    
            return response()->json([
                'message' => 'A gép sikeresen frissítve.',
                'data' => $machine
            ], 200);
    
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'error' => 'A frissíteni kívánt gép nem található.',
            ], 404);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'error' => 'Érvénytelen adatok.',
                'details' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Hiba történt a gép frissítése közben: ' . $e->getMessage(),
            ], 500);
        }
    }    

    public function destroy($id)
    {
        try {
            $machine = AgriculturalMachine::findOrFail($id);
            
            // Ellenőrizzük, hogy vannak-e aktív kölcsönzései a gépnek
            if ($machine->rentals()->count() > 0) {
                return response()->json([
                    'error' => 'A gép nem törölhető, mert aktív kölcsönzései vannak.',
                ], 422);
            }
            
            $machine->delete();
            return response()->json(['message' => 'A gép sikeresen törölve.'], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'error' => 'A törölni kívánt gép nem található.',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Hiba történt a gép törlése közben: ' . $e->getMessage(),
            ], 500);
        }
    }
    
}