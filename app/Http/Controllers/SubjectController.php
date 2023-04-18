<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SubjectController extends Controller
{
    public function index()
    {
        return view('subjects.index', [
            'subjects' => Subject::orderBy('code')->get(),
        ]);
    }

    public function create()
    {
        return view('subjects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|unique:subjects',
            'description' => 'required|string|unique:subjects',
            'units' => 'required|integer',
        ]);

        Subject::create($validated);

        return redirect()->route('subjects.create')
            ->with('status', 'Subject has been created');
    }

    public function edit(Subject $subject)
    {
        return view('subjects.edit', compact('subject'));
    }

    public function update(Request $request, Subject $subject)
    {
        $validated = $request->validate([
            'code' => ['required', Rule::unique(Subject::class)->ignore($subject)],
            'description' => ['required', Rule::unique(Subject::class)->ignore($subject)],
            'units' => 'required|integer',
        ]);

        $subject->update($validated);

        return redirect()->route('subjects.edit', $subject)
            ->with('status', 'Subject has been updated');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();

        return redirect()->route('subjects.index')
            ->with('status', 'Subject has been deleted');
    }
}
