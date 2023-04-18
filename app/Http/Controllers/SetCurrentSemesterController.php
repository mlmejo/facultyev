<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use Illuminate\Http\Request;

class SetCurrentSemesterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Semester $semester)
    {
        $currentSemester = Semester::where('current', true)->first();

        if ($currentSemester !== null) {
            $currentSemester->update([
                'current' => false,
            ]);
        }

        $semester->update([
            'current' => !$semester->current,
        ]);

        return redirect()->route('semesters.index');
    }
}
