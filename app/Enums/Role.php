<?php

namespace App\Enums;

enum Role: string
{
    case Admin = 'admin';
    case Instructor = 'instructor';
    case Staff = 'staff';
    case Student = 'student';
}
