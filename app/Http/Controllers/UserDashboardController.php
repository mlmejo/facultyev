<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        /**
         * @var \App\Models\User $currentUser
         */
        $currentUser = $request->user();

        if ($currentUser->hasRole(Role::Admin->value)) {
            return view('admin.dashboard');
        } else if ($currentUser->hasRole(Role::Instructor->value)) {
            return view('instructors.dashboard');
        } else if ($currentUser->hasRole(Role::Student->value)) {
            return view('students.dashboard');
        }

        return abort(403);
    }
}
