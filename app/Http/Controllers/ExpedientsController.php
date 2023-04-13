<?php

namespace App\Http\Controllers;

use App\Models\Expedients;
use Illuminate\Http\Request;


class ExpedientsController extends Controller
{
    public function index()
    {
        $expedients = Expedients::with('cartes_trucades')->get();
        return view('expedients', compact('expedients'));
    }

    public function create()
    {
        return view('expedients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        Expedients::create($request->all());

        return redirect()->route('expedients.index')
            ->with('success', 'Expedient created successfully.');
    }

    public function show(Expedients $expedient)
    {
        return view('expedients.show', compact('expedient'));
    }

    public function edit(Expedients $expedient)
    {
        return view('expedients.edit', compact('expedient'));
    }

    public function update(Request $request, Expedients $expedient)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $expedient->update($request->all());

        return redirect()->route('expedients.index')
            ->with('success', 'Expedient updated successfully');
    }

    public function destroy(Expedients $expedient)
    {
        $expedient->delete();

        return redirect()->route('expedients.index')
            ->with('success', 'Expedient deleted successfully');
    }
}