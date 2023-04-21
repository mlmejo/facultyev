<?php

namespace App\Http\Controllers;

use App\Models\Questionnaire;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Http\Request;

class RatingResultController extends Controller
{
    public function index()
    {
        return view('results.index', [
            'sections' => Section::all(),
        ]);
    }

    public function print(Request $request, Student $student)
    {
        $request->validate([
            'section_id' => 'required|exists:sections,id',
        ]);

        $questionnaire = Questionnaire::first();

        $section = Section::find($request->section_id);

        return view('results.print', compact('questionnaire', 'section', 'student'));
    }
}
