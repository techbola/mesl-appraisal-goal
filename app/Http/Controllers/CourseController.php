<?php

namespace Cavidel\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function course_dashboard()
    {
        return view('LMS.course_dashboard');
    }
}
