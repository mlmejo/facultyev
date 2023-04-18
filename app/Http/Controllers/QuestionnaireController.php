<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Questionnaire;
use App\Models\Semester;
use Illuminate\Http\Request;
use League\Csv\Reader;

class QuestionnaireController extends Controller
{
    public function index()
    {
        return view('questionnaires.index', [
            'questionnaire' => Questionnaire::first(),
        ]);
    }

    public function create()
    {
        return view('questionnaires.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'document' => 'required|file|mimes:csv,txt',
        ]);

        $file = $request->file('document');

        $reader = Reader::createFromPath($file->getPathname());
        $reader->setHeaderOffset(0);

        $currentSemester = Semester::where('current', true)->firstOrFail();

        $currentSemester->questionnaires()->delete();

        $questionnaire = Questionnaire::create([
            'semester_id' => $currentSemester->id,
        ]);

        /**
         * @var \App\Models\Category|null $category
         */
        $category = null;

        foreach ($reader->getRecords(['category', 'subcategory', 'question']) as $record) {
            $c = $record['category'];
            $sc = $record['subcategory'];

            if (!empty($c)) {
                $category = new Category([
                    'name' => $c
                ]);

                $questionnaire->categories()->save($category);

                continue;
            }

            if (!empty($sc)) {
                $category = new Category([
                    'name' => $sc,
                    'parent_id' => $category->id,
                ]);

                $questionnaire->categories()->save($category);

                continue;
            }

            $category->questions()->create([
                'content' => $record['question']
            ]);
        }

        return redirect()->route('questionnaires.index')
            ->with('status', 'Document has been uploaded.');
    }
}
