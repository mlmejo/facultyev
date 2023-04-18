<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    public function index()
    {
        return view('semesters.index', [
            'semesters' => Semester::orderBy('start_date')->get(),
        ]);
    }

    public function create()
    {
        return view('semesters.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        Semester::create($validated);

        return redirect()->route('semesters.create')
            ->with('status', 'Semester has been created.');
    }
}
