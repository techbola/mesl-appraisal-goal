<?php

namespace MESL\Http\Controllers;

use Illuminate\Http\Request;
use MESL\Document;
use MESL\DocType;
use MESL\DocCategory;
use MESL\DocSubCategory;
use MESL\Role;
use MESL\Staff;
use MESL\Workflow;
use MESL\Department;
use MESL\HrInitiatedDocs;
use Auth;
use DB;

class DocumentController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->is_superadmin) {
            $docs = Document::orderBy('DocRef', 'desc')->get();
        } elseif ($user->hasRole('Admin')) {
            $docs = Document::where('CompanyID', $user->staff->CompanyID)->orderBy('DocRef', 'desc')->get();
        }
        return view('documents.index', compact('docs'));
    }

    public function my_documents()
    {
        $user     = Auth::user();
        $mds_data = DocType::where('CompanyID', $user->staff->CompanyID)
            ->where('DocSubCategoryID', 2)
            ->get()
            ->transform(function ($item, $key) {
                $item->id   = $item->DocTypeRef;
                $item->text = $item->DocType;
                return $item->only(['id', 'text']);
            });
        $others_data = DocType::where('CompanyID', $user->staff->CompanyID)
            ->where('DocSubCategoryID', 0)
            ->get()
            ->transform(function ($item, $key) {
                $item->id   = $item->DocTypeRef;
                $item->text = $item->DocType;
                return $item->only(['id', 'text']);
            });

        // dd($others_data);
        if ($user->is_superadmin) {
            $docs              = Document::orderBy('DocRef', 'desc')->get();
            $doctypes          = DocType::all();
            $doc_cat_types     = DocCategory::all();
            $doc_sub_cat_types = DocSubCategory::all();
            $roles             = Role::all();
            $staff             = Staff::all();
            $departments       = Department::all();
        } else {
            $docs = Document::where('CompanyID', $user->staff->CompanyID)->where('ApprovedFlag', '1')->where('NotifyFlag', '1')->where(function ($query1) use ($user) {
                $query1->whereHas('assignees', function ($query) use ($user) {
                    $query->where('StaffID', $user->staff->StaffRef);
                });
            })->orWhere('Initiator', $user->id)->orderBy('DocRef', 'desc')->get();

            $doctypes          = DocType::where('CompanyID', $user->staff->CompanyID)->get();
            $roles             = Role::where('CompanyID', $user->staff->CompanyID)->get();
            $staff             = Staff::where('CompanyID', $user->staff->CompanyID)->get();
            $doc_sub_cat_types = DocSubCategory::all();
            $departments       = Department::where('CompanyID', $user->CompanyID)->get();
            $doc_cat_types     = DocCategory::all();
        }
        return view('documents.my_docs', compact('docs', 'doctypes', 'doc_cat_types', 'doc_sub_cat_types', 'roles', 'staff', 'departments', 'mds_data', 'others_data'));
    }

    public function send($id)
    {
        $doc             = Document::findorFail($id);
        $doc->NotifyFlag = true;
        if ($doc->save()) {
            // TODO: send notification here
            return redirect()->route('my_documents')->with('success', 'Document has been sent for approval successfully');
        } else {
            return back()->withInput()->with('error', 'Failed to send document for approval');
        }
    }

    public function approval_list()
    {
        // all approval IDs for a documents.
        $document_workflow = Workflow::where('ModuleID', 1)->get(['ApproverID1', 'ApproverID2', 'ApproverID3', 'ApproverID4', 'ApproverID5', 'ApproverID6', 'ApproverID7', 'ApproverID8', 'ApproverID9', 'ApproverID10']);

        // unapproved docs
        $unapproved_docs = Document::where('ApproverID', auth()->user()->id)->where('NotifyFlag', 1)->where('ApprovedFlag', 0)->get();

        // approved docs
        // $approved_docs = Document::where('ApproverID', 0)
        //     ->where('ApprovedFlag', 1)
        //     ->get();
        $approved_docs = Document::where('ApproverID', auth()->user()->id)->where('NotifyFlag', 1)->where('ApprovedFlag', 1)->get();

        return view('documents.approvallist', compact('approved_docs', 'unapproved_docs'));
    }

    public function store(Request $request)
    {
        // $this->validate($request, [
        //   'DocName' => 'required',
        //   'ApproverID' => 'required',
        // ]);

        $user = auth()->user();

        try {
            DB::beginTransaction();

            if ($request->hasFile('Filename')) {
                $filename = $request->Filename->getClientOriginalName();
                $saved    = $request->Filename->storeAs('documents', $filename);

                if ($saved) {
                    $document = new Document(array(
                        'DocTypeID'   => $request->DocTypeID,
                        'DocName'     => $request->DocName,
                        'Description' => $request->Description,
                        'Initiator'   => Auth::user()->id,
                        'CompanyID'   => Auth::user()->staff->CompanyID,
                        'Filename'    => $request->Filename->getClientOriginalName(),
                        // 'Path' => Storage::url('documents/'.$filename)
                    ));
                    if (!empty($request->ApproverID)) {
                        $document->ApproverID = $request->ApproverID;
                        // $document->NotifyFlag = '1';
                    }
                    $document->save();

                    // Declare assignees array.
                    $assignees = [];

                    // Start Roles
                    if (!empty($request->Roles)) {
                        if (in_array('all', $request->Roles)) {
                            $staffs = Staff::where('CompanyID', $user->staff->CompanyID)->get();
                            foreach ($staffs as $staff) {
                                $assignees[] = $staff->StaffRef;
                            }
                        } else {
                            foreach ($request->Roles as $role_id) {
                                $role = Role::find($role_id);
                                foreach ($role->users as $r_user) {
                                    $assignees[] = $r_user->staff->StaffRef;
                                }
                            }
                        }
                    }
                    // End Roles

                    // Start Staff
                    if (!empty($request->Staff)) {
                        // $assignees = [];
                        if (in_array('all', $request->Staff)) {
                            $staffs = Staff::where('CompanyID', $user->staff->CompanyID)->get();
                            foreach ($staffs as $staff) {
                                $assignees[] = $staff->StaffRef;
                            }
                        } else {
                            foreach ($request->Staff as $staff_id) {
                                $staff       = Staff::find($staff_id);
                                $assignees[] = $staff->StaffRef;
                            }
                        }
                    }
                    // End Staff

                    // Start Departments
                    if (!empty($request->Departments)) {

                        foreach ($request->Departments as $dept_id) {
                            $dept = Department::find($dept_id);
                            foreach ($dept->staff() as $staff) {
                                $assignees[] = $staff->StaffRef;
                            }
                        }
                    }
                    // End Departments

                    $clean_assignees = array_unique($assignees);

                    // Second argument is for extra columns in the many to many table
                    $document->assignees()->attach($clean_assignees, ['Initiator' => $user->id]);

                }
            }
            DB::commit();
            return redirect()->route('my_documents')->with('success', 'Document was added successfully');

        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('error', 'Document failed to save');

        }

    }

    public function store_hr(Request $request)
    {
        // $this->validate($request, [
        //   'DocName' => 'required',
        //   'ApproverID' => 'required',
        // ]);

        $user = auth()->user();

        try {
            DB::beginTransaction();

            if ($request->hasFile('Filename')) {
                $filename = $request->Filename->getClientOriginalName();
                $saved    = $request->Filename->storeAs('documents', $filename);

                if ($saved) {
                    $document = new HrInitiatedDocs(array(
                        'DocTypeID'   => $request->DocTypeID,
                        'DocName'     => $request->DocName,
                        'Description' => $request->Description,
                        'StaffID'     => $request->StaffID,
                        'Initiator'   => Auth::user()->id,
                        'CompanyID'   => Auth::user()->staff->CompanyID,
                        'Filename'    => $request->Filename->getClientOriginalName(),
                        // 'Path' => Storage::url('documents/'.$filename)
                    ));
                    $document->save();

                }
            }
            DB::commit();
            // send email
            // $user->notify(new HID());
            return redirect('staff/' . $request->StaffID)->with('success', 'Document was added successfully');

        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('error', 'Document failed to save');

        }

    }

    public function update_document(Request $request, $id)
    {
        $user = auth()->user();

        try {
            DB::beginTransaction();

            $document = Document::find($id);

            $document->DocTypeID   = $request->DocTypeID;
            $document->DocName     = $request->DocName;
            $document->Description = $request->Description;
            $document->update();

            // Declare assignees array.
            $assignees = [];

            // Start Staff
            if (!empty($request->Staff)) {
                // $assignees = [];
                $document->assignees()->detach();
                if (in_array('all', $request->Staff)) {
                    $staffs = Staff::where('CompanyID', $user->staff->CompanyID)->get();
                    foreach ($staffs as $staff) {
                        $assignees[] = $staff->StaffRef;
                    }
                } else {
                    foreach ($request->Staff as $staff_id) {
                        $staff       = Staff::find($staff_id);
                        $assignees[] = $staff->StaffRef;
                    }
                }

            }
            // End Staff

            $clean_assignees = array_unique($assignees);

            // Second argument is for extra columns in the many to many table
            $document->assignees()->attach($clean_assignees, ['Initiator' => $user->id]);

            DB::commit();
            return redirect()->route('my_documents')->with('success', 'Document was added successfully');

        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('error', 'Document failed to save');

        }

    }

    public function hrdocs()
    {
        $hrdocs = HrInitiatedDocs::where('StaffID', auth()->user()->staff->StaffRef)
            ->get();
        return view('documents.hrdocs', compact('hrdocs'));
    }

    public function approve(Request $request)
    {
        foreach ($request->SelectedID as $id) {
            $doc                  = Document::findorFail($id);
            $doc->ApproverID      = auth()->user()->id;
            $doc->ApprovedFlag    = '1';
            $doc->ApprovalDate    = date('Y-m-d');
            $doc->ApproverComment = $request->Comment;
            $doc->update();
        }
        return 'ok';
    }

    public function fetch_doctypes(Request $request)
    {
        $ref      = $request->sub_cat_id;
        $user     = auth()->user();
        $doc_type = DocType::where('CompanyID', $user->staff->CompanyID)
            ->where('DocSubCategoryID', $ref)
            ->get()
            ->transform(function ($item, $key) {
                $item->id   = $item->DocTypeRef;
                $item->text = $item->DocType;
                return $item->only(['id', 'text']);
            });
        return $doc_type;

    }

}
