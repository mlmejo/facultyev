<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Models\Course;
use App\Models\Student;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class StudentController extends Controller
{
    public function index()
    {
        return view('students.index', [
            'students' => Student::all(),
        ]);
    }

    public function create()
    {
        return view('students.create', [
            'courses' => Course::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => ['required', 'confirmed', Password::defaults()],
            'course_id' => 'required|exists:courses,id',
        ]);

        $student = Student::create([
            'course_id' => $request->course_id,
        ]);

        /**
         * @var \App\Models\User $user
         */
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole(Role::Student->value);

        $student->user()->save($user);

        event(new Registered($user));

        return redirect()->route('students.create')
            ->with('status', 'Student account has been created.');
    }

    public function edit(Student $student)
    {
        $courses = Course::orderBy('name')->get();

        return view('students.edit', compact('student', 'courses'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique(User::class)->ignore($student->user)
            ],
            'course_id' => 'required|exists:courses,id',
        ]);

        $student->update(['course_id' => $request->course_id]);

        $student->user()->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('students.edit', $student)
            ->with('status', 'Student account has been updated.');
    }

    public function destroy(Student $student)
    {
        $student->user->delete();

        $student->delete();

        return redirect()->route('students.index')
            ->with('status', 'Student account has been deleted.');
    }
}
