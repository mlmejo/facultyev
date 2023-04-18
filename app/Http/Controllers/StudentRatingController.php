<?php

namespace App\Http\Controllers;

use App\Models\Questionnaire;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentRatingController extends Controller
{
    public function index(Request $request, Student $student)
    {
        $request->validate([
            'section_id' => 'required|exists:sections,id',
        ]);

        $questionnaire = Questionnaire::first();

        $section = Section::find($request->section_id);

        return view('students.ratings.index', compact('questionnaire', 'section', 'student'));
    }
}
