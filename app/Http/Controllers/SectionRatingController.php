<?php

namespace App\Http\Controllers;

use App\Models\Questionnaire;
use App\Models\Rating;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionRatingController extends Controller
{
    public function index(Section $section)
    {
        return view('ratings.index', compact('section'));
    }

    public function create(Section $section)
    {
        return view('ratings.create', [
            'questionnaire' => Questionnaire::first(),
            'section' => $section,
        ]);
    }

    public function store(Request $request, Section $section)
    {
        foreach ($request->except('_token') as $question_id => $rating) {
            Rating::create([
                'section_id' => $section->id,
                'question_id' => $question_id,
                'student_id' => request()->user()->userable->id,
                'value' => $rating,
            ]);
        }

        return redirect()->route('dashboard');
    }
}
