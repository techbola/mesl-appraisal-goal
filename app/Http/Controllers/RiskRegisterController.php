<?php

namespace MESL\Http\Controllers;

use MESL\RiskRegister;
use MESL\RiskType;
use MESL\ResidualRiskType;
use MESL\RiskTreatment;
use Illuminate\Http\Request;

class RiskRegisterController extends Controller
{
    public function index()
    {
        $risk_registers = RiskRegister::all();
        return view('risk_registers.index', compact('risk_registers'));
    }

    public function create()
    {
        $risk_registers      = RiskRegister::all();
        $risk_types          = RiskType::all();
        $residual_risk_types = ResidualRiskType::all();
        $risk_treatments     = RiskTreatment::all();
        return view('risk_registers.create', compact('risk_registers', 'risk_types', 'residual_risk_types', 'risk_treatments'));
    }

    public function store(Request $request)
    {
        $risk_register = new RiskRegister($request->all());
        if ($risk_register->save()) {
            return redirect()->route('risk-registers.index')->with('success', 'Entry to risk register was successful');
        } else {
            return back()->withInput()->with('error', 'Entry to risk register failed');
        }
    }

    public function edit($id)
    {
        $risk_register       = RiskRegister::findOrFail($id);
        $risk_types          = RiskType::all();
        $residual_risk_types = ResidualRiskType::all();
        $risk_treatments     = RiskTreatment::all();
        return view('risk_registers.edit', compact('risk_register', 'risk_types', 'residual_risk_types', 'risk_treatments'));
    }

    public function update(Request $request, $id)
    {
        $risk_register = RiskRegister::findOrFail($id);
        if ($risk_register->update($request->all())) {
            return redirect()->route('risk-registers.index')->with('success', 'Update on risk register was successful');
        } else {
            return back()->withInput()->with('error', 'Update to risk register failed');
        }
    }

}
