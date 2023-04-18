<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use App\Models\Program;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class InstructorController extends Controller
{
    public function index()
    {
        return view('instructors.index', [
            'instructors' => Instructor::all(),
        ]);
    }

    public function create()
    {
        return view('instructors.create', [
            'programs' => Program::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Password::defaults()],
            'program_id' => 'required|exists:programs,id',
        ]);

        $instructor = Instructor::create([
            'program_id' => $request->program_id,
        ]);

        $instructor->user()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('instructors.create')
            ->with('status', 'Instructor account has been created');
    }

    public function edit(Instructor $instructor)
    {
        $programs = Program::orderBy('name')->get();

        return view('instructors.edit', compact('instructor', 'programs'));
    }

    public function update(Request $request, Instructor $instructor)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique(User::class)->ignore($instructor->user)
            ],
            'program_id' => 'required|exists:programs,id',
        ]);

        $instructor->update(['program_id' => $request->program_id]);

        $instructor->user()->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('instructors.edit', $instructor)
            ->with('status', 'Instructor account has been updated.');
    }

    public function destroy(Instructor $instructor)
    {
        $instructor->user->delete();

        $instructor->delete();

        return redirect()->route('instructors.index')
            ->with('status', 'Instructor account has been deleted.');
    }
}
