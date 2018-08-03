<?php

namespace Cavidel\Http\Controllers;

use Cavidel\CourseCategory;
use Cavidel\Courses;
use Cavidel\Staff;
use Cavidel\CourseInstructor;
use Cavidel\CourseBatch;
use Cavidel\CourseMaterial;
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
        $add_new_course             = new CourseCategory($request->all());
        $add_new_course->entered_by = auth()->user()->id;
        $add_new_course->save();
        $count_course = CourseCategory::all()->count();
        return response()->json($count_course)->setStatusCode(200);
    }

    public function submit_new_course(Request $request)
    {
        $rand    = rand(10, 999);
        $number  = 'COURSE - ' . $rand;
        $user_id = auth()->user()->id;

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

    public function submit_course_material(Request $request)
    {
        $user_id = \Auth::user()->id;

        if ($request->hasFile('video_link')) {
            $filenamewithextension = $request->file('video_link')->getClientOriginalName();
            $filename              = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension             = $request->file('video_link')->getClientOriginalExtension();
            $filenametostore       = $filename . '_' . time() . '.' . $extension;
            $request->file('video_link')->storeAs('public/course_video', $filenametostore);

            $add_course_material             = new CourseMaterial($request->except(['video_link', 'document_link', 'youtube_link']));
            $add_course_material->video_link = $filenametostore;
            $add_course_material->entered_by = $user_id;
            $add_course_material->save();
            $count_material = CourseMaterial::where('course_id', $request->course_id)->get();
            return response()->json($count_material)->setStatusCode(200);

        } elseif ($request->hasFile('document_link')) {
            $filenamewithextension = $request->file('document_link')->getClientOriginalName();
            $filename              = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension             = $request->file('document_link')->getClientOriginalExtension();
            $filenametostore       = $filename . '_' . time() . '.' . $extension;
            $request->file('document_link')->storeAs('public/Course_Docs', $filenametostore);

            $add_course_material                = new CourseMaterial($request->except(['video_link', 'document_link', 'youtube_link']));
            $add_course_material->document_link = $filenametostore;
            // dd($filenametostore);
            $add_course_material->entered_by = $user_id;
            $add_course_material->save();
            $count_material = CourseMaterial::where('course_id', $request->course_id)->get();
            return response()->json($count_material)->setStatusCode(200);
        } else {
            $add_course_material             = new CourseMaterial($request->except(['video_link', 'document_link']));
            $add_course_material->entered_by = $user_id;
            $add_course_material->save();
            $count_material = CourseMaterial::where('course_id', $request->course_id)->get();
            return response()->json($count_material)->setStatusCode(200);
        }
    }

    public function get_course_material_list($id)
    {
        $id                      = $id;
        $course_material_details = CourseMaterial::where('course_id', $id)->get();
        return response()->json($course_material_details)->setStatusCode(200);
    }

    public function staff_course_dashboard()
    {
        $user_id        = \Auth::user()->id;
        $course_details = \DB::table('tblCourseBatch')
            ->select('cover_page', 'courses_name', 'description', 'course_code', 'batch_code', 'duration', 'start_date', 'end_date', 'priority', 'batch_ref')
            ->join('tblCourses', 'tblCourseBatch.course_id', '=', 'tblCourses.course_ref')
            ->where('staff_id', $user_id)
            ->where('status', 0)
            ->get();

        $active_courses = \DB::table('tblCourseBatch')
            ->select('cover_page', 'courses_name', 'description', 'course_code', 'batch_code', 'duration', 'start_date', 'end_date', 'priority', 'batch_ref')
            ->join('tblCourses', 'tblCourseBatch.course_id', '=', 'tblCourses.course_ref')
            ->where('staff_id', $user_id)
            ->where('status', 1)
            ->get();

        $completed_courses = \DB::table('tblCourseBatch')
            ->select('cover_page', 'courses_name', 'description', 'course_code', 'batch_code', 'duration', 'start_date', 'end_date', 'priority', 'batch_ref')
            ->join('tblCourses', 'tblCourseBatch.course_id', '=', 'tblCourses.course_ref')
            ->where('staff_id', $user_id)
            ->where('status', 2)
            ->get();

        return view('LMS.staff_course_dashboard', compact('course_details', 'active_courses', 'completed_courses'));
    }

    public function show_course($id)
    {
        $id             = $id;
        $course_details = \DB::table('tblCourseBatch')
            ->select('cover_page', 'courses_name', 'description', 'course_code', 'batch_code', 'duration', 'start_date', 'end_date', 'priority', 'batch_ref', 'tblCourseBatch.course_id')
            ->join('tblCourses', 'tblCourseBatch.course_id', '=', 'tblCourses.course_ref')
            ->where('batch_ref', $id)
            ->first();

        $course_id        = $course_details->course_id;
        $course_materials = CourseMaterial::where('course_id', $course_id)->get();
        return view('LMS.show_course', compact('course_details', 'course_materials'));
    }

    public function activate_course($id)
    {
        $id       = $id;
        $activate = \DB::table('tblCourseBatch')
            ->where('batch_ref', $id)
            ->update(['status' => 1]);
        return response()->json(['success' => true, ['data' => ['link' => route('ShowCourse', ['id' => $id])]]]);
    }

    public function course_material_with_id($id)
    {
        $id               = $id;
        $course_materials = CourseMaterial::where('course_material_ref', $id)->first();
        return response()->json($course_materials)->setStatusCode(200);
    }

}
