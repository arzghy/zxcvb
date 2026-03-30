<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Simulation;
use Illuminate\Http\Request;

class SimulationController extends Controller
{
    // ================= FUNGSI WEB (BROWSER) =================
    public function index()
    {
        $sim = Simulation::first() ?? new Simulation();
        return view('admin.simulation.index', compact('sim'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'bank_interest' => 'required|numeric',
            'stock_return' => 'required|numeric',
        ]);

        $sim = Simulation::first() ?? new Simulation();
        $sim->bank_interest = $request->bank_interest;
        $sim->stock_return = $request->stock_return;
        $sim->save();

        return back()->with('success', 'Parameter simulasi berhasil disimpan!');
    }

    // ================= FUNGSI API (POSTMAN) =================
    public function getApi()
    {
        $sim = Simulation::first() ?? new Simulation();
        return response()->json(['status' => 'success', 'data' => $sim], 200);
    }

    public function updateApi(Request $request)
    {
        $request->validate([
            'bank_interest' => 'required|numeric',
            'stock_return' => 'required|numeric',
        ]);

        $sim = Simulation::first() ?? new Simulation();
        $sim->bank_interest = $request->bank_interest;
        $sim->stock_return = $request->stock_return;
        $sim->save();

        return response()->json(['status' => 'success', 'message' => 'Parameter Simulasi diupdate!', 'data' => $sim], 200);
    }
}