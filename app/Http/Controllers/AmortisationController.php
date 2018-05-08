<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MonthlyAmortItem;
use App\MonthlyAmortisation;
use App\GL;

class AmortisationController extends Controller
{

  public function items()
  {
    $items = MonthlyAmortItem::all();
    return view('amortisation.items', compact('items'));
  }

  public function index()
  {
    $amorts = MonthlyAmortisation::all();
    $items = MonthlyAmortItem::all();
    $gls = GL::where('Description', '!=', NULL)->get();
    return view('amortisation.index', compact('amorts', 'items', 'gls'));
  }


  public function save_amort(Request $request)
  {
    $amort = MonthlyAmortisation::create($request->except(["_token", "MonthlyAmortItem", "MonthlyAmortItemID"]));

    // Amort Item
    if (!empty($request->MonthlyAmortItemID)) {
      $amort->MonthlyAmortItemID = $request->MonthlyAmortItemID;
    } elseif (!empty($request->MonthlyAmortItem)) {
      $item = new MonthlyAmortItem;
      $item->MonthlyAmortItem = $request->MonthlyAmortItem;
      $item->save();
      $amort->MonthlyAmortItemID = $item->MonthlyAmortItemRef;
    }

    $amort->save();

    return redirect()->back()->with('success', 'Amortisation saved successfully');
  }

  public function edit_amort($id)
  {
    $amort = MonthlyAmortisation::find($id);
    $items = MonthlyAmortItem::all();
    $gls = GL::where('Description', '!=', NULL)->get();
    return view('amortisation.edit', compact('amorts', 'items', 'gls', 'amort'));
  }

  public function update_amort(Request $request, $id)
  {
    $amort = MonthlyAmortisation::find($id);
    // $amort = MonthlyAmortisation::create($request->except(["_token", "MonthlyAmortItem", "MonthlyAmortItemID"]));
    $amort->fill($request->except(["_token", "_method", "MonthlyAmortItem", "MonthlyAmortItemID"]));

    // Amort Item
    if (!empty($request->MonthlyAmortItemID)) {
      $amort->MonthlyAmortItemID = $request->MonthlyAmortItemID;
    } elseif (!empty($request->MonthlyAmortItem)) {
      $item = new MonthlyAmortItem;
      $item->MonthlyAmortItem = $request->MonthlyAmortItem;
      $item->save();
      $amort->MonthlyAmortItemID = $item->MonthlyAmortItemRef;
    }

    $amort->update();

    return redirect()->route('amortisation-index')->with('success', 'Amortisation updated successfully');
  }

}
