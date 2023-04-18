<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Student;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class SectionStudentController extends Controller
{
    public function store(Request $request, Section $section)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
        ]);

        try {
            $section->students()->attach($request->student_id);
        } catch (QueryException $e) {
            return back()->withErrors([
                'student_id' => ['This student is already registered to this section.'],
            ])->onlyInput('student_id');
        }

        return redirect()->route('sections.edit', $section)
            ->with('status', 'Student has been added to section.');
    }

    public function destroy(Section $section, Student $student)
    {
        $section->students()->detach($student);

        return redirect()->route('sections.edit', $section)
            ->with('status', 'Student has been removed from this section.');
    }
}
