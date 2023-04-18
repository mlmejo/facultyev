<?php

namespace App\Http\Controllers;

use App\Models\Course;
use CurlHandle;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{
    public function index()
    {
        return view('courses.index', [
            'courses' => Course::orderBy('name')->get(),
        ]);
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:' . Course::class,
        ]);

        Course::create($validated);

        return redirect()->route('courses.create')
            ->with('status', 'Course has been created.');
    }

    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                Rule::unique(Course::class)->ignore($course),
            ],
        ]);

        $course->update($validated);

        return redirect()->route('courses.edit', $course)
            ->with('status', 'Course has been updated.');
    }

    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('courses.index')
            ->with('status', 'Course has been deleted');
    }
}
