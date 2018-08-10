<?php

namespace Cavidel\Http\Controllers;

use Illuminate\Http\Request;
use Cavidel\BusinessRelationshipType;
use Validator;

class BusinessRelationshipTypeController extends Controller
{
    public function store(Request $request)
    {
        $business_rel_type = new BusinessRelationshipType($request->all());
        $validator         = Validator::make($request->all(), [
            'RelationshipType' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->messages()->all()], 500);
        } else {
            if ($business_rel_type->save()) {
                return response()->json(['success' => true, 'data' => $business_rel_type, 'message' => 'Business Relationship Type was added'], 200);
            }

        }
    }
}
