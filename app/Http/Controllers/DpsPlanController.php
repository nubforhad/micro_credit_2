<?php

namespace App\Http\Controllers;

use App\Models\DpsPlan;
use Illuminate\Http\Request;


class DpsPlanController extends Controller
{


    public function index()
    {
        $plans = DpsPlan::latest()->get();

        return view(
            'modules.dps.plans.index',
            compact('plans')
        );
    }



    public function create()
    {
        return view(
            'modules.dps.plans.create'
        );
    }




    public function store(Request $request)
    {

        $request->validate([

            'name'=>'required',
            'duration_month'=>'required|numeric',
            'installment_amount'=>'required|numeric',
            'interest_rate'=>'required|numeric',

        ]);



        DpsPlan::create([

            'name'=>$request->name,

            'duration_month'=>$request->duration_month,

            'installment_amount'=>$request->installment_amount,

            'interest_rate'=>$request->interest_rate,

            'status'=>$request->status,

        ]);



        return redirect()
        ->route('dps-plans.index')
        ->with(
            'success',
            'DPS Plan Created Successfully'
        );

    }





    public function edit($id)
    {

        $plan = DpsPlan::findOrFail($id);


        return view(
            'modules.dps.plans.edit',
            compact('plan')
        );

    }





    public function update(Request $request,$id)
    {


        $plan = DpsPlan::findOrFail($id);



        $request->validate([

            'name'=>'required',
            'duration_month'=>'required',
            'installment_amount'=>'required',
            'interest_rate'=>'required',

        ]);



        $plan->update([

            'name'=>$request->name,

            'duration_month'=>$request->duration_month,

            'installment_amount'=>$request->installment_amount,

            'interest_rate'=>$request->interest_rate,

            'status'=>$request->status,

        ]);



        return redirect()
        ->route('dps-plans.index')
        ->with(
            'success',
            'DPS Plan Updated Successfully'
        );


    }





    public function destroy($id)
    {

        DpsPlan::findOrFail($id)->delete();


        return redirect()
        ->route('dps-plans.index')
        ->with(
            'success',
            'DPS Plan Deleted Successfully'
        );

    }


}