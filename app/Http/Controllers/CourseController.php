<?php

namespace MESL\Http\Controllers;

use MESL\CourseCategory;
use MESL\Courses;
use MESL\Staff;
use MESL\CourseInstructor;
use MESL\CourseBatch;
use MESL\Question;
use MESL\TestScore;
use MESL\CourseModule;
use MESL\ModuleQuestion;
use MESL\CourseMaterial;
use MESL\ModuleExamCollation;
use MESL\ExamCollation;
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

            $counter = 1;
            while ($counter <= (int) $request->Module_No) {
                $new_module             = new CourseModule();
                $new_module->CourseID   = $add_new_course->course_ref;
                $new_module->Module     = 'Module ' . $counter;
                $new_module->InputterID = $user_id;
                $new_module->save();
                $counter++;
            }

            return response()->json($count_course)->setStatusCode(200);
        } else {

            $add_new_course              = new Courses($request->all());
            $add_new_course->course_code = $number;
            $add_new_course->entered_by  = $user_id;
            $add_new_course->save();
            $count_course = Courses::all()->count();

            $counter = 1;
            while ($counter <= (int) $request->Module_No) {
                $new_module             = new CourseModule();
                $new_module->CourseID   = $add_new_course->course_ref;
                $new_module->Module     = 'Module ' . $counter;
                $new_module->InputterID = $user_id;
                $new_module->save();
                $counter++;
            }

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

            $add_course_material             = new CourseMaterial($request->except(['video_link', 'document_link', 'youtube_link', 'audio_link']));
            $add_course_material->video_link = $filenametostore;
            $add_course_material->entered_by = $user_id;
            $add_course_material->save();
            $count_material = CourseMaterial::where('course_id', $request->course_id)->get();
            return response()->json($count_material)->setStatusCode(200);

            //     //audio link storage
        } elseif ($request->hasFile('audio_link')) {
            $filenamewithextension = $request->file('audio_link')->getClientOriginalName();
            $filename              = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension             = $request->file('audio_link')->getClientOriginalExtension();
            $filenametostore       = $filename . '_' . time() . '.' . $extension;
            $request->file('audio_link')->storeAs('public/course_audio', $filenametostore);

            $add_course_material             = new CourseMaterial($request->except(['video_link', 'document_link', 'youtube_link', 'audio_link']));
            $add_course_material->audio_link = $filenametostore;
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
        $course_modules          = CourseModule::where('CourseID', $id)->get();

        $details = [
            'material' => $course_material_details,
            'module'   => $course_modules,
        ];

        return response()->json($details)->setStatusCode(200);
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
            ->select('cover_page', 'courses_name', 'description', 'course_ref', 'course_code', 'batch_code', 'duration', 'start_date', 'end_date', 'priority', 'batch_ref', 'tblCourseBatch.course_id')
            ->join('tblCourses', 'tblCourseBatch.course_id', '=', 'tblCourses.course_ref')
            ->where('batch_ref', $id)
            ->first();

        $exam_attempt = ExamCollation::where('CourseID', $course_details->course_ref)
        ->where('CustomerRef', auth()->user()->id)
        ->get();

        $course_id        = $course_details->course_id;
        $courses          = Courses::where('course_ref', $course_id)->first();
        $course_materials = CourseMaterial::where('course_id', $course_id)->get();
        return view('LMS.show_course', compact('course_details', 'course_materials', 'id', 'courses', 'exam_attempt'));

        //checkbox function
        $checkbox->$course_details = $request->input('checkbox');
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

    public function get_c_category()
    {
        $course_category = CourseCategory::all();
        return response()->json($course_category)->setStatusCode(200);
    }

    public function get_category_edit_data($id)
    {
        $ref                 = $id;
        $get_course_category = CourseCategory::where('course_category_ref', $ref)->first();
        return response()->json($get_course_category)->setStatusCode(200);
    }

    public function submit_course_category_edit_form(Request $request)
    {
        $ref                        = $request->course_category_ref;
        $data                       = CourseCategory::where('course_category_ref', $ref)->first();
        $data->course_category_name = $request->course_category_name;
        $data->save();
        $categories = CourseCategory::all();
        return response()->json($categories)->setStatusCode(200);
    }

    public function get_course_details($id)
    {
        $ref                = $id;
        $get_course_content = Courses::where('course_ref', $ref)->first();
        return response()->json($get_course_content)->setStatusCode(200);
    }

    public function submit_edit_course_form(Request $request)
    {
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

            $add_new_course                  = Courses::where('course_ref', $request->course_ref)->first();
            $add_new_course->courses_name    = $request->courses_name;
            $add_new_course->course_duration = $request->course_duration;
            $add_new_course->course_fee      = $request->course_fee;
            $add_new_course->category_ref    = $request->category_ref;
            $add_new_course->description     = $request->description;
            $add_new_course->cover_page      = $filenametostore;
            $add_new_course->save();
            $courses = Courses::all();
            return response()->json($courses)->setStatusCode(200);
        } else {

            $add_new_course                  = Courses::where('course_ref', $request->course_ref)->first();
            $add_new_course->courses_name    = $request->courses_name;
            $add_new_course->course_duration = $request->course_duration;
            $add_new_course->course_fee      = $request->course_fee;
            $add_new_course->category_ref    = $request->category_ref;
            $add_new_course->description     = $request->description;
            $add_new_course->save();
            $courses = Courses::all();
            return response()->json($courses)->setStatusCode(200);
        }
    }

    public function delete_course_category($ref)
    {
        try {
            \DB::beginTransaction();
            $delete_course_category = CourseCategory::where('course_category_ref', $ref)->delete();
            $categories             = \DB::table('tblCourseCategory')
                ->join('users', 'tblCourseCategory.entered_by', '=', 'users.id')
                ->get();
            \DB::commit();
            return response()->json($categories)->setStatusCode(200);
        } catch (Exception $e) {
            \DB::rollback();
            return response($content = 'failed', $status = 200);
        }
    }

    public function delete_course($ref)
    {
        try {
            \DB::beginTransaction();
            $delete_course = Courses::where('course_ref', $ref)->delete();
            $courses       = Courses::all();
            \DB::commit();
            return response()->json($courses)->setStatusCode(200);
        } catch (Exception $e) {
            \DB::rollback();
            return response($content = 'failed', $status = 200);
        }
    }

    public function view_course_details($ref)
    {
        try {
            \DB::beginTransaction();
            $get_details = Courses::where('course_ref', $ref)
                ->join('tblCourseCategory', 'tblCourses.category_ref', '=', 'tblCourseCategory.course_category_ref')
                ->first();
            \DB::commit();
            return response()->json($get_details)->setStatusCode(200);
        } catch (Exception $e) {
            \DB::rollback();
            return response($content = 'failed', $status = 200);
        }
    }

    public function get_question_limit($id)
    {
        try {
            \DB::beginTransaction();

            $get_question   = Question::where('CourseID', $id)->count();
            $question_limit = Courses::where('course_ref', $id)->first();

            $details = [
                'question_count' => $get_question,
                'limit'          => $question_limit->final_question_limit,
            ];

            \DB::commit();
            return response()->json($details)->setStatusCode(200);
        } catch (Exception $e) {
            \DB::rollback();
            return response($content = 'failed', $status = 200);
        }
    }

    public function post_submit_record(Request $request)
    {
        try {
            \DB::beginTransaction();
            $user_id                  = auth()->user()->id;
            $post_details             = new Question($request->all());
            $post_details->InputterID = $user_id;
            $post_details->save();
            \DB::commit();
            return response($content = 'ok', $status = 200);
        } catch (Exception $e) {
            \DB::rollback();
            return response($content = 'failed', $status = 200);
        }
    }

    public function find_new_question($course_ref, $batch_ref)
    {
        try {
            \DB::beginTransaction();
            $user_id              = auth()->user()->id;
            $course_details       = Courses::where('course_ref', $course_ref)->first();
            $check_exam_collation = ExamCollation::where('BatchRef', $batch_ref)
                ->where('CourseID', $course_ref)
                ->where('CustomerRef', $user_id)
                ->get();

            $date_now = \Carbon\Carbon::now();
            $data     = $date_now->addMinutes($course_details->exam_duration);
            $datte    = $data->format('F j\\, Y  H:i:s');

            if (count($check_exam_collation) == $course_details->final_question_limit) {
                $get_result = ExamCollation::where('BatchRef', $batch_ref)
                    ->where('CourseID', $course_ref)
                    ->where('CustomerRef', $user_id)
                    ->where('Status', 1)
                    ->count();

                $question = Question::where('CourseID', $course_ref)
                    ->inRandomOrder()
                    ->first();

                $final = 1;

                $pass_mark   = $course_details->course_pass_mark;
                $unit_score  = 100 / $course_details->final_question_limit;
                $final_score = $unit_score * $get_result;

            } else {
                $question = Question::where('CourseID', $course_ref)
                    ->whereNotIn('QuestionRef', $check_exam_collation->pluck('QuestionID')->toArray())
                    ->inRandomOrder()
                    ->first();

                $get_result = ExamCollation::where('BatchRef', $batch_ref)
                    ->where('CourseID', $course_ref)
                    ->where('CustomerRef', $user_id)
                    ->where('Status', 1)
                    ->count();

                $final = 0;

                $pass_mark   = $course_details->course_pass_mark;
                $unit_score  = 100 / $course_details->final_question_limit;
                $final_score = $unit_score * $get_result;
            }

            $details = [
                'question'     => $question,
                'total_result' => $get_result,
                'total'        => $check_exam_collation,
                'limit'        => $course_details->final_question_limit,
                'final'        => $final,
                'pass_mark'    => $pass_mark,
                'unit_score'   => $unit_score,
                'final_score'  => $final_score,
                'datte'        => $datte,
            ];

            \DB::commit();
            return response()->json($details)->setStatusCode(200);
        } catch (Exception $e) {
            \DB::rollback();
            return response($content = 'failed', $status = 200);
        }
    }

    public function process_examination_question(Request $request, $batch, $course_ref)
    {
        try {
            \DB::beginTransaction();
            $user_id             = auth()->user()->id;
            $course_details      = Courses::where('course_ref', $course_ref)->first();
            $get_question_answer = Question::where('QuestionRef', $request->QuestionID)->first();

            if ($get_question_answer->Final_Answer == $request->Answer) {
                $question_status = 1;
            } else {
                $question_status = 0;
            }

            // Submit Question And answer
            $submit_details              = new ExamCollation($request->all());
            $submit_details->CustomerRef = $user_id;
            $submit_details->CourseID    = $course_ref;
            $submit_details->BatchRef    = $batch;
            $submit_details->Status      = $question_status;
            $answer_submission           = $submit_details->save();

            if ($answer_submission) {
                $check_exam_collation = ExamCollation::where('BatchRef', $batch)
                    ->where('CourseID', $course_ref)
                    ->where('CustomerRef', $user_id)
                    ->get();

                if (count($check_exam_collation) == $course_details->final_question_limit) {
                    $get_result = ExamCollation::where('BatchRef', $batch)
                        ->where('CourseID', $course_ref)
                        ->where('CustomerRef', $user_id)
                        ->where('Status', 1)
                        ->count();

                    $question = Question::where('CourseID', $course_ref)
                        ->inRandomOrder()
                        ->first();

                    $final = 1;

                    $pass_mark   = $course_details->course_pass_mark;
                    $unit_score  = 100 / $course_details->final_question_limit;
                    $final_score = $unit_score * $get_result;

                    $update_test              = new TestScore();
                    $update_test->CustomerRef = $user_id;
                    $update_test->CourseID    = $course_ref;
                    $update_test->BatchID     = $batch;
                    $update_test->Score       = $final_score;
                    $update_test->save();

                } else {
                    $question = Question::where('CourseID', $course_ref)
                        ->whereNotIn('QuestionRef', $check_exam_collation->pluck('QuestionID')->toArray())
                        ->inRandomOrder()
                        ->first();

                    $get_result = ExamCollation::where('BatchRef', $batch)
                        ->where('CourseID', $course_ref)
                        ->where('CustomerRef', $user_id)
                        ->where('Status', 1)
                        ->count();

                    $final = 0;

                    $pass_mark   = $course_details->course_pass_mark;
                    $unit_score  = 100 / $course_details->final_question_limit;
                    $final_score = $unit_score * $get_result;
                }
            }

            $get_previous = ExamCollation::where('BatchRef', $batch)
                ->where('CourseID', $course_ref)
                ->where('CustomerRef', $user_id)
                ->get()->toArray();

            $details = [
                'question'          => $question,
                'total_result'      => $get_result,
                'total'             => $check_exam_collation,
                'limit'             => $course_details->final_question_limit,
                'final'             => $final,
                'pass_mark'         => $pass_mark,
                'unit_score'        => $unit_score,
                'final_score'       => $final_score,
                'previous_question' => $get_previous,
            ];

            \DB::commit();
            return response()->json($details)->setStatusCode(200);
        } catch (Exception $e) {
            \DB::rollback();
            return response($content = 'failed', $status = 200);
        }

    }

    public function get_final_test_result($batch, $course_ref)
    {
        try {
            \DB::beginTransaction();
            $user_id    = auth()->user()->id;
            $get_result = ExamCollation::where('BatchRef', $batch)
                ->join('tblQuestion', 'tblExamCollation.QuestionID', '=', 'tblQuestion.QuestionRef')
                ->where('tblExamCollation.CourseID', $course_ref)
                ->where('CustomerRef', $user_id)
                ->get();

            $passed = ExamCollation::where('BatchRef', $batch)
                ->where('CourseID', $course_ref)
                ->where('CustomerRef', $user_id)
                ->where('Status', 1)
                ->count();

            $failed = ExamCollation::where('BatchRef', $batch)
                ->where('CourseID', $course_ref)
                ->where('CustomerRef', $user_id)
                ->where('Status', 0)
                ->count();

            $details = [
                'result' => $get_result,
                'passed' => $passed,
                'failed' => $failed,
            ];

            \DB::commit();
            return response()->json($details)->setStatusCode(200);
        } catch (Exception $e) {
            \DB::rollback();
            return response($content = 'failed', $status = 200);
        }
    }

    public function get_exam_review_questions($course_ref, $batch_ref)
    {
        try {
            \DB::beginTransaction();
            $user_id = auth()->user()->id;
            $reviews = ExamCollation::where('BatchRef', $batch_ref)
                ->join('tblQuestion', 'tblExamCollation.QuestionID', '=', 'tblQuestion.QuestionRef')
                ->where('tblExamCollation.CourseID', $course_ref)
                ->where('CustomerRef', $user_id)
                ->where('Status', 0)
                ->get();
            \DB::commit();
            return response()->json($reviews)->setStatusCode(200);
        } catch (Exception $e) {
            \DB::rollback();
            return response($content = 'failed', $status = 200);
        }
    }

    public function reset_exam_question($course_ref, $batch_ref)
    {
        try {
            \DB::beginTransaction();
            $user_id = auth()->user()->id;
            $reset   = ExamCollation::where('BatchRef', $batch_ref)
                ->where('tblExamCollation.CourseID', $course_ref)
                ->where('CustomerRef', $user_id)
                ->delete();
            \DB::commit();
            return response($content = 'ok', $status = 200);
        } catch (Exception $e) {
            \DB::rollback();
            return response($content = 'failed', $status = 200);
        }
    }

    public function get_all_course_module($id)
    {
        try {
            \DB::beginTransaction();
            $courses = Courses::where('course_ref', $id)->first();
            $modules = CourseModule::where('CourseID', $id)->get();

            $details = [
                'courses' => $courses,
                'modules' => $modules,
            ];

            \DB::commit();
            return response()->json($details)->setStatusCode(200);
        } catch (Exception $e) {
            \DB::rollback();
            return response($content = 'failed', $status = 200);
        }
    }

    public function post_module_question_record(Request $request)
    {
        try {
            \DB::beginTransaction();
            $user_id                   = auth()->user()->id;
            $post_question             = new ModuleQuestion($request->all());
            $post_question->InputterID = $user_id;
            $post_question->save();
            \DB::commit();
            return response($content = 'ok', $status = 200);
        } catch (Exception $e) {
            \DB::rollback();
            return response($content = 'failed', $status = 200);
        }
    }

    public function get_course_module_questions($id, $course_id)
    {
        try {
            \DB::beginTransaction();
            $questions = ModuleQuestion::where('ModuleID', $id)
                ->where('CourseID', $course_id)
                ->get();
            \DB::commit();
            return response()->json($questions)->setStatusCode(200);
        } catch (Exception $e) {
            \DB::rollback();
            return response($content = 'failed', $status = 200);
        }
    }

    public function post_module_examination(Request $request)
    {
        try {
            \DB::beginTransaction();
            foreach ($request->Answer as $key => $value) {
                # code...
            }
            \DB::commit();

        } catch (Exception $e) {
            \DB::rollback();

        }
    }

    public function view_and_edit_question()
    {
        $courses = Courses::all();
        return view('LMS.view_edit_questions', compact('courses'));
    }

    public function get_course_module_for_edit($ref)
    {
        try {
            \DB::beginTransaction();
            $details = CourseModule::where('CourseID', $ref)->get();
            \DB::commit();
            return response()->json($details)->setStatusCode(200);
        } catch (Exception $e) {
            \DB::rollback();
            return response($content = 'failed', $status = 200);
        }
    }

    public function search_course_module($course_ref, $module_ref)
    {
        try {
            \DB::beginTransaction();
            $questions = ModuleQuestion::where('CourseID', $course_ref)
                ->where('ModuleID', $module_ref)
                ->get();
            \DB::commit();
            return response()->json($questions)->setStatusCode(200);
        } catch (Exception $e) {
            \DB::rollback();
            return response($content = 'failed', $status = 200);
        }
    }

    public function get_module_question_by_id($id)
    {
        try {
            \DB::beginTransaction();
            $questions = ModuleQuestion::where('ModuleQuestionRef', $id)
                ->first();
            \DB::commit();
            return response()->json($questions)->setStatusCode(200);
        } catch (Exception $e) {
            \DB::rollback();
            return response($content = 'failed', $status = 200);
        }
    }

    public function post_editted_course_module(Request $request, $ref)
    {
        try {
            \DB::beginTransaction();
            $details = ModuleQuestion::where('ModuleQuestionRef', $ref)->first();
            if ($details->update($request->except(['_token', '_method']))) {
                $questions = ModuleQuestion::where('CourseID', $details->CourseID)
                    ->where('ModuleID', $details->ModuleID)
                    ->get();
            }
            \DB::commit();
            return response()->json($questions)->setStatusCode(200);
        } catch (Exception $e) {
            \DB::rollback();
            return response($content = 'failed', $status = 200);
        }
    }

    public function delete_module_question($ref)
    {
        try {
            \DB::beginTransaction();
            $details    = ModuleQuestion::where('ModuleQuestionRef', $ref)->first();
            $course_ref = $details->CourseID;
            $module_ref = $details->ModuleID;
            $trans      = $details->delete();
            if ($trans) {
                $questions = ModuleQuestion::where('CourseID', $course_ref)
                    ->where('ModuleID', $module_ref)
                    ->get();
            }
            \DB::commit();
            return response()->json($questions)->setStatusCode(200);
        } catch (Exception $e) {
            \DB::rollback();
            return response($content = 'failed', $status = 200);
        }
    }

    public function search_course_question($ref)
    {
        try {
            \DB::beginTransaction();
            $details = Question::where('CourseID', $ref)->get();
            \DB::commit();
            return response()->json($details)->setStatusCode(200);
        } catch (Exception $e) {
            \DB::rollback();
            return response($content = 'failed', $status = 200);
        }
    }

    public function get_editted_question($ref)
    {
        try {
            \DB::beginTransaction();
            $details = Question::where('QuestionRef', $ref)->first();
            \DB::commit();
            return response()->json($details)->setStatusCode(200);
        } catch (Exception $e) {
            \DB::rollback();
            return response($content = 'failed', $status = 200);
        }
    }

    public function get_course_cateory_details($ref)
    {
        try {
            \DB::beginTransaction();
            $details = CourseCategory::where('course_category_ref', $ref)->first();
            \DB::commit();
            return response()->json($details)->setStatusCode(200);
        } catch (Exception $e) {
            \DB::rollback();
            return response($content = 'failed', $status = 200);
        }
    }

    public function post_edited_course_category($ref, $name)
    {
        try {
            \DB::beginTransaction();
            $details = CourseCategory::where('course_category_ref', $ref)->update(['course_category_name' => $name]);
            if ($details) {
                $categories = \DB::table('tblCourseCategory')
                    ->join('users', 'tblCourseCategory.entered_by', '=', 'users.id')
                    ->get();
            }
            \DB::commit();
            return response()->json($categories)->setStatusCode(200);
        } catch (Exception $e) {
            \DB::rollback();
            return response($content = 'failed', $status = 200);
        }
    }

    public function process_final_exam_questions($ref)
    {
        try {
            \DB::beginTransaction();
            $serial_number = 1;
            $user_id       = auth()->user()->id;
            $courses = Courses::where('course_ref', $ref)->first();
            $get_courses   = Question::where('CourseID', $ref)->inRandomOrder()->limit($courses->final_question_limit)->get();
            foreach ($get_courses as $key => $value) {
                $increase                     = $serial_number++;
                $exam_collation               = new ExamCollation();
                $exam_collation->QuestionID   = $value->QuestionRef;
                $exam_collation->CustomerRef  = $user_id;
                $exam_collation->CourseID     = $ref;
                $exam_collation->SerialNumber = $increase;
                $exam_collation->save();
            }
            \DB::commit();
            return response($content = 'ok', $status = 200);
        } catch (Exception $e) {
            \DB::rollback();
            return response($content = 'failed', $status = 200);
        }
    }


    public function get_final_exam_questions($ref)
    {
        try {
            \DB::beginTransaction();
            $user_id        = auth()->user()->id;
            $course_details = Courses::where('course_ref', $ref)->first();
            $counter_status = ExamCollation::where('CustomerRef', $user_id)
                ->where('CourseID', $ref)
                ->get();
            $exam_question = ExamCollation::where('CustomerRef', $user_id)
                ->where('CourseID', $ref)
                ->where('Status', 0)
                ->with('question')
                ->first();
            \DB::commit();
            return view('LMS.final_exam', compact('exam_question', 'course_details', 'counter_status'));
        } catch (Exception $e) {
            \DB::rollback();
            return redirect()->route('Show_Course', $ref);
        }
    }

    public function post_final_exam_result(Request $request, $ref, $course_ref)
    {
        try {
            \DB::beginTransaction();
            $user_id  = auth()->user()->id;
            $question = ExamCollation::where('CourseID', $course_ref)
                ->where('CustomerRef', $user_id)
                ->where('SerialNumber', $ref)
                ->first();
            if (!empty($request->Answer)) {
                $question->Answer = $request->Answer;
                $question->Status = 1;
                $question->save();

                // Update result Status
                $get_question_final_answer = Question::where('QuestionRef', $question->QuestionID)->first();
                if ($get_question_final_answer->Final_Answer == $request->Answer) 
                {
                    $question->ResultStatus = 1;
                    $question->save();
                }

                // Increment the present question with by 1 then Check if the next question is available.
                $new_number   = $ref + 1;
                $new_question = ExamCollation::where('CustomerRef', $user_id)
                    ->where('CourseID', $course_ref)
                    ->where('SerialNumber', $new_number)
                    ->with('question')
                    ->first();
                if (!empty($new_question)) {
                    $next_question  = $new_question;
                    $counter_status = ExamCollation::where('CustomerRef', $user_id)
                        ->where('CourseID', $course_ref)
                        ->get();
                }
            } else {
                $new_number   = $ref + 1;
                $new_question = ExamCollation::where('CustomerRef', $user_id)
                    ->where('CourseID', $course_ref)
                    ->where('SerialNumber', $new_number)
                    ->with('question')
                    ->first();
                if (!empty($new_question)) {
                    $next_question  = $new_question;
                    $counter_status = ExamCollation::where('CustomerRef', $user_id)
                        ->where('CourseID', $course_ref)
                        ->get();
                }
            }

            $records = [
                'counters'     => $counter_status,
                'question' => $new_question,
            ];

            \DB::commit();
            return response()->json($records)->setStatusCode(200);
        } catch (Exception $e) {
            \DB::rollback();
            return response($content = 'failed', $status = 200);
        }
    }

    public function get_status_questions($ref, $course_ref)
    {
        try {
              \DB::beginTransaction();
               $user_id        = auth()->user()->id;
               $new_question = ExamCollation::where('CustomerRef', $user_id)
                    ->where('CourseID', $course_ref)
                    ->where('SerialNumber', $ref)
                    ->with('question')
                    ->first();
                $counter_status = ExamCollation::where('CustomerRef', $user_id)
                        ->where('CourseID', $course_ref)
                        ->get();
                $records = [
                'counters'     => $counter_status,
                'question' => $new_question,
            ];
              \DB::commit();
                    return response()->json($records)->setStatusCode(200);
          } catch (Exception $e) {
               \DB::rollback();
                   return response($content = 'failed', $status = 200);
          }
    }

    public function submit_last_questions_answer(Request $request, $ref, $course_ref)
    {
        try {
              \DB::beginTransaction();
            $user_id  = auth()->user()->id;
            $question = ExamCollation::where('CourseID', $course_ref)
                ->where('CustomerRef', $user_id)
                ->where('SerialNumber', $ref)
                ->first();
            if (!empty($request->Answer)) {
                $question->Answer = $request->Answer;
                $question->Status = 1;
                $question->save();

                // Update result Status
                $get_question_final_answer = Question::where('QuestionRef', $question->QuestionID)->first();
                if ($get_question_final_answer->Final_Answer == $request->Answer) 
                {
                    $question->ResultStatus = 1;
                    $question->save();
                }

                $new_question = ExamCollation::where('CustomerRef', $user_id)
                    ->where('CourseID', $course_ref)
                    ->where('SerialNumber', $ref)
                    ->with('question')
                    ->first();
                $counter_status = ExamCollation::where('CustomerRef', $user_id)
                        ->where('CourseID', $course_ref)
                        ->get();
            }else{
                $new_question = ExamCollation::where('CustomerRef', $user_id)
                    ->where('CourseID', $course_ref)
                    ->where('SerialNumber', $ref)
                    ->with('question')
                    ->first();
                $counter_status = ExamCollation::where('CustomerRef', $user_id)
                        ->where('CourseID', $course_ref)
                        ->get();
            }
            $records = [
                'counters'     => $counter_status,
                'question' => $new_question,
            ];
              \DB::commit();
                    return response()->json($records)->setStatusCode(200);
        } catch (Exception $e) {
            \DB::rollback();
            return response($content = 'failed', $status = 200);
        }
    }

     public function show_final_result($course_ref)
    {
        try {
              \DB::beginTransaction();
                        $user_id  = auth()->user()->id;
                        $course_details = Courses::where('course_ref', $course_ref)->first();
                        $final_exam_collation_result = ExamCollation::where('CourseID', $course_ref)
                        ->where('CustomerRef', $user_id)
                        ->where('ResultStatus', 1)
                        ->count();

                        //Return score back to view in percentage
                        $score_in_percentage = ($final_exam_collation_result / $course_details->final_question_limit) * 100;
                        $details = [
                            'course'     => $course_details,
                            'result' => $score_in_percentage,
                        ];

              \DB::commit();
                    return response()->json($details)->setStatusCode(200);
          } catch (Exception $e) {
               \DB::rollback();
                   return response($content = 'failed', $status = 200);
          }
    }

    public function submit_course_module_results(Request $request)
    {
        try {

            \DB::beginTransaction();
            $user_id = auth()->user()->id;
            foreach ($request->Answer as $key => $value) {
                $new_data              = new ModuleExamCollation();
                $new_data->QuestionID  = $request->QuestionID[$key];
                $new_data->CustomerRef = $user_id;
                $new_data->Answer      = $request->Answer[$key];
                $new_data->ModuleID    = $request->ModuleID[$key];
                $new_data->CourseID    = $request->CourseID[$key];
                $new_data->save(); 

                $get_course_details = ModuleQuestion::where('ModuleQuestionRef', $request->QuestionID[$key])->first();
                $get_inserted_record = ModuleExamCollation::where('ModuleExamCollationRef', $new_data->ModuleExamCollationRef)->first();
                if ($get_course_details->Final_Answer == $get_inserted_record->Answer) {
                    $update_module_question = ModuleExamCollation::where('ModuleExamCollationRef', $get_inserted_record->ModuleExamCollationRef)->update(['Status'=>1]);
                }
            }

            $get_exam_result = ModuleExamCollation::where('CourseID', $request->CourseID[0])
                ->where('CustomerRef', $user_id)
                ->where('status', 1)
                ->count();

            $get_course_module = CourseModule::where('ModuleRef', $request->ModuleID[0])->first();
             //Return score back to view in percentage
             $score_in_percentage = ($get_exam_result / $get_course_module->QuestionLimit) * 100; 

             $result_questions = ModuleExamCollation::where('tblModuleExamCollation.CourseID', $request->CourseID[0])
             ->where('CustomerRef', $user_id)
             ->join('tblModuleQuestion', 'tblModuleExamCollation.QuestionID', '=', 'tblModuleQuestion.ModuleQuestionRef')
             ->select('Final_Answer', 'Answer', 'ModuleQuestionRef', 'Question', 'Answer_A', 'Answer_B', 'Answer_C', 'Answer_D')
             ->get();

             $details = [
                'result' => $score_in_percentage,
                'pass_mark' => (int)$get_course_module->PassMark,
                'result_questions' => $result_questions,
            ]; 

            \DB::commit();
            return response()->json($details)->setStatusCode(200);
        } catch (Exception $e) {
            \DB::rollback();
            return response($content = 'failed', $status = 200);
        }
    }

     public function get_course_module_details($ref)
    {
        $details = CourseModule::where('CourseID', $ref)->get();
        return response()->json($details)->setStatusCode(200);
    }

    public function get_all_course_module_details($ref)
    {
        $details = CourseModule::where('ModuleRef', $ref)->first();
        return response()->json($details)->setStatusCode(200);
    }

    public function course_module_criteria_submission(Request $request, $ref)
    {
        try {
              \DB::beginTransaction();
                $get_record = CourseModule::where('ModuleRef', $ref)->first();
                $update_details = $get_record->update($request->except(['_token', '_method']));
                if($update_details)
                {
                    $details = CourseModule::where('CourseID', $get_record->CourseID)->get();
                }
              \DB::commit();
                    return response()->json($details)->setStatusCode(200);
          } catch (Exception $e) {
               \DB::rollback();
                    return response($content = 'failed', $status = 200);
          }
    }
}
