<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Instructor;
use App\Models\Program;
use App\Models\Section;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use League\Csv\Reader;

class UploadedCsvController extends Controller
{
    public function courseUpload(Request $request)
    {
        $request->validate([
            'document' => 'required',
        ]);

        $file = $request->file('document');

        $reader = Reader::createFromPath($file->getPathname());
        $reader->setHeaderOffset(0);

        foreach ($reader->getRecords(['name']) as $record) {
            Course::firstOrCreate([
                'name' => $record['name'],
            ]);
        }

        return redirect()->route('courses.index')
            ->with('status', 'Document has been imported.');
    }

    public function programUpload(Request $request)
    {
        $request->validate([
            'document' => 'required|file|mimes:csv,txt',
        ]);

        $file = $request->file('document');

        $reader = Reader::createFromPath($file->getPathname());
        $reader->setHeaderOffset(0);

        foreach ($reader->getRecords(['name']) as $record) {
            Program::firstOrCreate([
                'name' => $record['name'],
            ]);
        }

        return redirect()->route('programs.index')
            ->with('status', 'Document has been imported.');
    }

    public function subjectUpload(Request $request)
    {
        $request->validate([
            'document' => 'required|file|mimes:csv,txt',
        ]);

        $file = $request->file('document');

        $reader = Reader::createFromPath($file->getPathname());
        $reader->setHeaderOffset(0);

        foreach ($reader->getRecords(['code', 'description', 'units']) as $record) {
            Subject::firstOrCreate([
                'code' => $record['code'],
                'description' => $record['description'],
                'units' => $record['units'],
            ]);
        }

        return redirect()->route('subjects.index')
            ->with('status', 'Document has been imported.');
    }

    public function instructorUpload(Request $request)
    {
        $request->validate([
            'document' => 'required',
        ]);

        $file = $request->file('document');

        $reader = Reader::createFromPath($file->getPathname());
        $reader->setHeaderOffset(0);

        foreach ($reader->getRecords(['name', 'email', 'program_id']) as $record) {
            $user = User::create([
                'name' => $record['name'],
                'email' => $record['email'],
                'password' => Hash::make('luceatluxvestra'),
            ]);

            $user->assignRole('instructor');

            Instructor::create([
                'user_id' => $user->id,
                'program_id' => $record['program_id'],
            ]);
        }

        return redirect()->route('instructors.index')
            ->with('status', 'Document has been imported.');
    }

    public function studentUpload(Request $request)
    {
        $request->validate([
            'document' => 'required',
        ]);

        $file = $request->file('document');

        $reader = Reader::createFromPath($file->getPathname());
        $reader->setHeaderOffset(0);

        foreach ($reader->getRecords(['name', 'email', 'course_id']) as $record) {
            $user = User::create([
                'name' => $record['name'],
                'email' => $record['email'],
                'password' => Hash::make('luceatluxvestra'),
            ]);

            Instructor::create([
                'user_id' => $user->id,
                'course_id' => $record['course_id'],
            ]);

            $user->assignRole('student');

            event(new Registered($user));
        }

        return redirect()->route('students.index')
            ->with('status', 'Document has been imported.');
    }

    public function sectionUpload(Request $request)
    {
        $request->validate([
            'document' => 'required',
        ]);

        $file = $request->file('document');

        $reader = Reader::createFromPath($file->getPathname());
        $reader->setHeaderOffset(0);

        foreach ($reader->getRecords(['subject_id', 'instructor_id']) as $record) {
            Section::firstOrCreate([
                'subject_id' => $record['subject_id'],
                'instructor_id' => $record['instructor_id'],
            ]);
        }

        return redirect()->route('sections.index')
            ->with('status', 'Document has been imported.');
    }
}
