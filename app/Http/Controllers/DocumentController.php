<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Document;
use App\DocType;
use App\Role;
use Auth;
use DB;

class DocumentController extends Controller
{
  public function index()
  {
      $user = Auth::user();

      if($user->is_superadmin){
        $docs = Document::orderBy('DocRef', 'desc')->get();
      } elseif($user->hasRole('Admin')) {
        $docs = Document::where('CompanyID', $user->staff->CompanyID)->orderBy('DocRef', 'desc')->get();
      }
      return view('documents.index', compact('docs'));
  }

  public function my_documents()
  {
      $user = Auth::user();
      if($user->is_superadmin){
        $docs = Document::orderBy('DocRef', 'desc')->get();
        $doctypes = DocType::all();
        $roles = Role::all();
      } else {
        $docs = Document::whereHas('assignees', function($query) use($user){
          $query->where('StaffRef', $user->staff->StaffRef);
        })->orWhere('Initiator', $user->id)->orderBy('DocRef', 'desc')->get();
        $doctypes = DocType::where('CompanyID', $user->staff->CompanyID)->get();
        $roles = Role::where('CompanyID', $user->staff->CompanyID)->get();
      }
      return view('documents.my_docs', compact('docs', 'doctypes', 'roles'));
  }



    public function store(Request $request)
    {
      $user = auth()->user();

      try {
        DB::beginTransaction();

        if ($request->hasFile('Filename')) {
            $filename = $request->Filename->getClientOriginalName();
            $saved    = $request->Filename->storeAs('documents', $filename);

            if ($saved) {
                $document = new Document(array(
                    'DocTypeID'       => $request->DocTypeID,
                    'DocName'         => $request->DocName,
                    'Description'     => $request->Description,
                    'Initiator'       => Auth::user()->id,
                    'Filename'        => $request->Filename->getClientOriginalName(),
                    // 'Path' => Storage::url('documents/'.$filename)
                ));
                $document->save();

                if (!empty($request->Roles)) {
                  $assignees = [];
                  foreach ($request->Roles as $role_id) {
                    $role = Role::find($role_id);
                    foreach ($role->users as $r_user) {
                      $assignees[] = $r_user->staff->StaffRef;
                    }
                  }
                  $document->assignees()->attach($assignees, ['Initiator'=>$user->id]);

                } else {

                }

            }
        }
        DB::commit();
        return redirect()->route('my_documents')->with('success', 'Document was added successfully');

      } catch (Exception $e) {
        DB::rollback();
        return redirect()->back()->withInput()->with('error', 'Document failed to save');

      }

  }


}
