<?php

namespace Cavidel\Http\Controllers;

use Cavidel\CourseCategory;
use Cavidel\Courses;
use Cavidel\Staff;
use Cavidel\CourseInstructor;
use Cavidel\CourseBatch;
use Image;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function course_dashboard()
    {
        $course_count     = CourseCategory::all()->count();
        $categories       = CourseCategory::all();
        $course           = Courses::all()->count();
        $instructor_count = CourseInstructor::all()->count();
        $course_names     = Courses::all();
        $batch_counter    = CourseBatch::all()->groupBy('batch_code')->count();
        $users            = \DB::table('users')
            ->select('id', \DB::raw('CONCAT("last_name", \'  \' ,"first_name") AS Fullname'))
            ->get();
        return view('LMS.course_dashboard', compact('course_count', 'categories', 'course', 'users', 'instructor_count', 'course_names', 'batch_counter'));
    }

    public function submit_new_category(Request $request)
    {
        $add_new_course = new CourseCategory($request->all());
        $add_new_course->save();
        $count_course = CourseCategory::all()->count();
        return response()->json($count_course)->setStatusCode(200);
    }

    public function submit_new_course(Request $request)
    {
        $rand    = rand(10, 999);
        $number  = 'COURSE - ' . $rand;
        $user_id = \Auth::user()->id;

        if ($request->hasFile('cover_page')) {
            $filenamewithextension = $request->file('cover_page')->getClientOriginalName();
            $filename              = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension             = $request->file('cover_page')->getClientOriginalExtension();
            $filenametostore       = $filename . '_' . time() . '.' . $extension;
            $request->file('cover_page')->storeAs('public/course_images', $filenametostore);
            $request->file('cover_page')->storeAs('public/course_images/thumbnail', $filenametostore);
            $thumbnailpath = public_path('storage/course_images/thumbnail/' . $filenametostore);
            $img           = Image::make($thumbnailpath)->resize(400, 400, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($thumbnailpath);

            $add_new_course              = new Courses($request->all());
            $add_new_course->course_code = $number;
            $add_new_course->cover_page  = $filenametostore;
            $add_new_course->entered_by  = $user_id;
            $add_new_course->save();
            $count_course = Courses::all()->count();
            return response()->json($count_course)->setStatusCode(200);
        } else {

            $add_new_course              = new Courses($request->all());
            $add_new_course->course_code = $number;
            $add_new_course->entered_by  = $user_id;
            $add_new_course->save();
            $count_course = Courses::all()->count();
            return response()->json($count_course)->setStatusCode(200);
        }
    }

    public function get_staff_details($id)
    {
        $id      = $id;
        $details = \DB::table('tblStaff')
            ->select('users.email', 'Company', 'MobilePhone', 'tblCompany.Address')
            ->join('tblCompany', 'tblStaff.CompanyID', '=', 'tblCompany.CompanyRef')
            ->join('users', 'tblStaff.UserID', '=', 'users.id')
            ->where('UserID', $id)
            ->first();
        return response()->json($details)->setStatusCode(200);
    }

    public function submit_new_instructor(Request $request)
    {
        $add_new_instructor = new CourseInstructor($request->except('inst'));
        $add_new_instructor->save();
        $instructor_counter = CourseInstructor::all()->count();
        return response()->json($instructor_counter)->setStatusCode(200);
    }

    public function get_course_duration($id)
    {
        $id           = $id;
        $get_duration = Courses::where('course_ref', $id)->first();
        return response()->json($get_duration)->setStatusCode(200);
    }

    public function submit_new_batch(Request $request)
    {
        $rand    = rand(1000, 9999);
        $number  = 'BAT - ' . $rand;
        $user_id = \Auth::user()->id;

        foreach ($request->staff_id as $ref) {
            $new_batch             = new CourseBatch($request->except('staff_id'));
            $new_batch->batch_code = $number;
            $new_batch->staff_id   = $ref;
            $new_batch->entered_by = $user_id;
            $new_batch->save();
        }
        $batch_counter = CourseBatch::all()->groupBy('batch_code')->count();
        return response()->json($batch_counter)->setStatusCode(200);
    }

    public function get_course_category_list()
    {
        $categories = \DB::table('tblCourseCategory')
            ->join('users', 'tblCourseCategory.entered_by', '=', 'users.id')
            ->get();
        return response()->json($categories)->setStatusCode(200);
    }

    public function get_course_list()
    {
        $courses = \DB::table('tblCourses')
            ->join('users', 'tblCourses.entered_by', '=', 'users.id')
            ->get();
        return response()->json($courses)->setStatusCode(200);
    }

    public function get_instructor_list()
    {
        $instructors = CourseInstructor::all();
        return response()->json($instructors)->setStatusCode(200);
    }

    public function get_batch_list()
    {
        $batch = \DB::table('tblCourseBatch')
            ->select('batch_code', 'tblCourses.courses_name')
            ->join('tblCourses', 'tblCourseBatch.course_id', '=', 'tblCourses.course_ref')
            ->groupBy('batch_code', 'tblCourses.courses_name')
            ->get();
        return response()->json($batch)->setStatusCode(200);
    }
}
