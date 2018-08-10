<?php

namespace Cavidel\Http\Controllers;

use Illuminate\Http\Request;
use Cavidel\User;
use Cavidel\Court;
use Cavidel\Contact;
use Cavidel\Country;
use Cavidel\Litigation;
use Cavidel\BusinessRelationshipType;
use DB, Validator;
use Cavidel\LitigationFile;

class LitigationController extends Controller
{
    // Add new schedule
    public function index()
    {
        $user  = auth()->user();
        $users = User::whereHas('staff', function ($q) use ($user) {
            $q->where('CompanyID', $user->CompanyID);
        })->get();

        if ($user->is_superadmin) {
            $contacts = Contact::orderBy('Customer')->get();
        } else {
            $contacts = Contact::where('CompanyID', $user->staff->CompanyID)->orderBy('Customer')->get();
        }

        $litigations        = Litigation::all();
        $countries          = Country::orderBy('Country', 'asc')->get();
        $relationship_types = BusinessRelationshipType::select(['BusinessRelationshipTypeRef', 'RelationshipType'])->get();
        //  return business contacts created by current user;
        $contacts = Contact::where('InputterID', auth()->user()->id)->select(['CustomerRef', 'Customer', 'Department'])->get();
        $courts   = Court::select(['CourtRef', 'Court', 'Location'])->get();
        return view('litigation.index', compact('courts', 'contacts', 'litigations', 'relationship_types', 'countries', 'users'));
    }

    // stores litigation schedule
    public function store(Request $request)
    {
        $validator = Validator::make($request->except('LitigationStatus'), [
            'CaseNumber' => 'required',
        ], [
            'CaseNumber.required' => 'Case Number is required',
        ]);

        if ($validator->fails()) {
            return back()->withInput()->withErrors();
        } else {
            // start process
            try {
                DB::beginTransaction();
                $litigation             = new Litigation($request->except('LitigationStatus'));
                $status                 = $request->LitigationStatus;
                $litigation->InputterID = auth()->user()->id;
                $litigation->save();
                $litigation->comments()->create(['LitigationStatus' => $status]);
                DB::commit();
                return redirect()->route('litigation')->with('success', 'Litigation Schedule created successfully');
            } catch (Exception $e) {
                DB::rollback();
                return back()->withInput()->withErrors($e->getMessages());
            }
        }
    }

    public function show($id)
    {
        $litigation = Litigation::find($id);
        $contacts   = Contact::where('InputterID', auth()->user()->id)->select(['CustomerRef', 'Customer', 'Department'])->get();
        $courts     = Court::select(['CourtRef', 'Court', 'Location'])->get();
        $statuses   = $litigation->comments;
        return view('litigation.show', compact('litigation', 'statuses', 'contacts', 'courts'));
    }

    public function update(Request $request, $id)
    {
        $litigation = Litigation::find($id);
        $validator  = Validator::make($request->except('LitigationStatus'), [
            'CaseNumber' => 'required',
        ], [
            'CaseNumber.required' => 'Case Number is required',
        ]);

        if ($validator->fails()) {
            return back()->withInput()->withErrors();
        } else {
            try {
                DB::beginTransaction();
                $status              = $request->LitigationStatus;
                $request->ModifierID = auth()->user()->id;
                $litigation->update($request->except('LitigationStatus'));
                if ($request->has('LitigationStatus')) {
                    $litigation->comments()->create(['LitigationStatus' => $status]);
                }
                DB::commit();
                return redirect()->route('litigation.show', $id)->with('success', 'Litigation Schedule updated successfully');
            } catch (Exception $e) {
                DB::rollback();
                return back()->withInput()->withErrors($e->getMessages());
            }
        }
    }

    public function upload_litigation_file(Request $request, $id)
    {
        $litigation = Litigation::find($id);
        $file       = $request->Filename;
        $user       = auth()->user();

        if ($request->hasFile('Filename') && $request->file('Filename')->isValid()) {
            $filename = str_replace(' ', '_', $file->getClientOriginalName());
            $saved    = $file->storeAs('litigation_files', $filename, 'public');

            if ($saved) {
                $new_file               = new LitigationFile;
                $new_file->Filename     = $filename;
                $new_file->LitigationID = $litigation->LitigationRef;
                $new_file->UserID       = $user->id;
                $new_file->save();
            }
        }
        return redirect()->back()->with('success', 'The file was uploaded successfully');
    }
}
