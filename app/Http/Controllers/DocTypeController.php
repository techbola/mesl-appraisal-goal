<?php

namespace MESL\Http\Controllers;

use MESL\DocType;
use MESL\DocCategory;
use MESL\Staff;
use Auth;
use MESL\Company;
use MESL\SubCategory;
use Illuminate\Http\Request;

class DocTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $DocTypes = DocType::all();
        return view('doctypes.create', compact('DocTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $DocType = new DocType($request->all());
        $this->validate($request, [
            'DocType' => 'required',
        ]);
        if ($DocType->save()) {
            return redirect()->route('doctypes.create')->with('success', 'DocType was added successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'DocType failed to save');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $DocTypes = DocType::all();
        $DocType   = DocType::where('DocTypeRef', $id)->first();
        // return dd($TradeRef);
        return view('doctypes.edit', compact('DocType', 'DocTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $DocType = \DB::table('tblDocType')->where('DocTypeRef', $id);
        if ($DocType->update($request->except(['_token', '_method']))) {
            return redirect()->route('doctypes.create')->with('success', 'DocType was updated successfully');
        } else {
            return back()->withInput()->with('error', 'DocType failed to update');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function doctype()
    {
        $staff = Staff::all();
        $doctypes = DocType::Orderby('DocTypeRef', 'DESC')->get();
        $doc_category = DocCategory::all();
        $company = Auth::user()->staff->CompanyID;
        return view('documents.doctype', compact('doctypes', 'doc_category', 'staff', 'company'));
    }

    public function store_doctype(Request $request)
    {

        $company = Auth::user()->staff->CompanyID;

        $doctype = new Doctype($request->all());
            if($doctype->save()) {
                $data = [
                    'status'    => 'success',
                    'message'   => ' Document was created successfully!'
                ];
            }else{
                $data = [
                    'status'    => 'error',
                    'message'   =>  ' Document creation was not successful!'
                ];
            }

            return redirect()->route('StoreDoctype')->with($data['status'], $data['message']);
    }

    // Sub category functions
    public function subcategory()
    {
        $subcategories = SubCategory::Orderby('SubCategoryRef', 'DESC')->get();
        $category = DocCategory::all();
        return view('documents.sub_category', compact('subcategories', 'category'));
    }

    public function store_subcategory(Request $request)
    {
        $subcategory = new SubCategory($request->all());
            if($subcategory->save()) {
                $data = [
                    'status'    => 'success',
                    'message'   => ' SubCategory was created successfully!'
                ];
            }else{
                $data = [
                    'status'    => 'error',
                    'message'   =>  ' SubCategory creation was not successful!'
                ];
            }

            return redirect()->route('Storesubcategory')->with($data['status'], $data['message']);
        }

        //Edit Sub category
    public function edit_sub_category($id)
    {
        $subcategory = SubCategory::where("SubCategoryRef", $id)->first();

        return response()->json($subcategory);
    }

    public function delete_subcategory($id)
    {
        $subcategory = SubCategory::find($id);

        $subcategory->delete();
        return redirect()->route('documents.sub_category', compact('subcategory'))->with('success',  'Deleted successfully');
    }

    public function doc_category()
    {
        $doccategories = DocCategory::Orderby('DocCategoryRef', 'DESC')->get();
        return view('documents.doc_category', compact('doccategories'));
    }

    public function store_doccategory(Request $request)
    {
        $doc_category = new DocCategory($request->all());

        if($doc_category->save()) {
            $data = [
                'status'    => 'success',
                'message'   => 'Category was created successfully!'
            ];
        }else{
            $data = [
                'status'    => 'error',
                'message'   =>  'Category creation was not successful!'
            ];
        }

        return redirect()->route('StoreDocCat')->with($data['status'], $data['message']);
    }

    public function edit_doc_category($id)
    {
        $doccategory = DocCategory::where("DocCategoryRef", $id)->first();

        return response()->json($doccategory);
    }

    public function delete_doc_category($id)
    {
        $doccategory = DocCategory::where("DocCategoryRef", $id);

        $doccategory->delete();

        return redirect()->back()->with('success',  'Deleted successfully');
    }

    public function update_doc_category(Request $request)
    {
        $doccategory = DocCategory::find($request->DocCategoryRef);

        $doccategory->update($request->except(['_token']));

        return redirect()->back()->with('success',  'Updated successfully');
    }

    public function edit_doctype($id)
    {
        $doctype = Doctype::where('DocTypeRef', $id);
        return response()->json($doctype);
    }
}
