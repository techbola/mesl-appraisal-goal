<?php

namespace Cavidel\Http\Controllers;

use Cavidel\Customer;
use Cavidel\ClientDocument;
use Cavidel\DocType;
use Illuminate\Http\Request;

class ClientDocumentController extends Controller
{
    public function client_list($id)
    {
        $client_id        = $id;
        $client_details   = Customer::where('CustomerRef', $client_id)->first();
        $client_documents = \DB::table('tblClientDocuments')
            ->join('tblDocType', 'tblClientDocuments.DocType_id', '=', 'tblDocType.DocTypeRef')
            ->where('ClientID', $client_id)
            ->get();
        return view('client_document.client_document_list', compact('client_details', 'client_documents'));
    }

    public function add_client_document($id)
    {
        $client_id      = $id;
        $client_details = Customer::where('CustomerRef', $client_id)->first();
        $doc_type       = DocType::all();
        return view('client_document.add_client_document', compact('client_details', 'doc_type'));
    }

    public function store_client_document(Request $request)
    {
        $this->validate($request, [
            'Filename'   => 'required',
            'DocType_id' => 'required',
        ]);

        $client_document              = new ClientDocument;
        $client_document->DocType_id  = $request->DocType_id;
        $client_document->UploadDate  = $request->UploadDate;
        $client_document->DocName     = $request->DocName;
        $client_document->Description = $request->Description;
        $client_document->Initiator   = $request->Initiator;
        $client_document->StaffID     = $request->StaffID;
        $client_document->ClientID    = $request->ClientID;

        if ($request->hasFile('Filename')) {

            $filenamewithextension     = $request->file('Filename')->getClientOriginalName();
            $filename                  = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension                 = $request->file('Filename')->getClientOriginalExtension();
            $filenametostore           = str_slug($filename) . time() . '.' . $extension;
            $saveFile                  = $request->file('Filename')->storeAs('public/ClientDocument', $filenametostore);
            $client_document->Filename = $filenametostore;

            if ($client_document->save()) {
                return redirect()->route('Client_Document_List', [$request->ClientID])->with('success', 'Client Document uploaded successfully');
            } else {
                return redirect()->back()->withInput()->with('error', 'Client Document failed to upload');
            }
        }
    }

    public function approve_document()
    {
        $client_documents = \DB::table('tblClientDocuments')
            ->join('tblDocType', 'tblClientDocuments.DocType_id', '=', 'tblDocType.DocTypeRef')
            ->where('Status', 0)
            ->get();
        return view('client_document.approve_document', compact('client_documents'));
    }

    public function approve_post_document(Request $request)
    {
        $doc_id         = $request->doc_id;
        $update_details = \DB::table('tblClientDocuments')->where('DocRef', $doc_id)->update(['Status' => 1]);
        if ($update_details) {
            return redirect()->route('Approve_Document')->with('success', 'Document Approved');
        } else {
            return redirect()->back()->with('error', 'Document Not Approved');
        }

    }

    public function delete_client_document(Request $request)
    {
        $id         = $request->doc_id;
        $client_ref = $request->client_id;
        $trans      = ClientDocument::where('DocRef', '=', $id)->delete();
        if ($trans) {
            return redirect()->route('Client_Document_List', [$client_ref])->with('success', 'Document Deleted Successfully');
        } else {
            return redirect()->back()->with('error', 'Document deletion was not successful');
        }
    }
}
