<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use App\Models\Section;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index()
    {
        return view('sections.index', [
            'sections' => Section::all(),
        ]);
    }

    public function create()
    {
        return view('sections.create', [
            'instructors' => Instructor::all(),
            'subjects' => Subject::orderBy('code')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'instructor_id' => 'required|exists:instructors,id',
        ]);

        Section::create($validated);

        return redirect()->route('sections.create')
            ->with('status', 'Section has been created');
    }

    public function edit(Section $section)
    {
        $students = Student::all();

        return view('sections.edit', compact('section', 'students'));
    }

    public function destroy(Section $section)
    {
        $section->delete();

        return redirect()->route('sections.index')
            ->with('status', 'Section has been deleted.');
    }
}
