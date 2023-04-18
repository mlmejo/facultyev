<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $currentUser = $request->user();

        if ($currentUser->hasRole(Role::Admin->value)) {
            return view('admin.dashboard');
        }
    }
}
