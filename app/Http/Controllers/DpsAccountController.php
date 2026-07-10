<?php

namespace App\Http\Controllers;

use App\Models\DpsAccount;
use App\Models\DpsPlan;
use App\Models\Member;
use Illuminate\Http\Request;
use Carbon\Carbon;


class DpsAccountController extends Controller
{
 
public function index()
{
    $accounts = DpsAccount::with([
        'member',
        'plan'
    ])->latest()->get();
    $members = Member::latest()->get();
    $plans = DpsPlan::where('status', 'active')->get();
    return view(
        'modules.dps.accounts.index',
        compact('accounts', 'members', 'plans')
    );
}
 
    public function create()
    {
        $members = Member::latest()->get();
        $plans = DpsPlan::where( 'status', 'active' )->get(); 
        return view( 'modules.dps.accounts.create', compact('members',  'plans') );

    }
 
    public function store(Request $request)
    {
        $request->validate([
            'member_id'=>'required',
            'dps_plan_id'=>'required',
            'start_date'=>'required',
        ]);
        $plan = DpsPlan::findOrFail(
            $request->dps_plan_id
        );
        $startDate = Carbon::parse(
            $request->start_date
        );
        $maturityDate = $startDate->copy()
        ->addMonths(
            $plan->duration_month
        );

        $accountNo = "DPS-"
        .date('Y')
        .rand(1000,9999);
        DpsAccount::create([
            'member_id'=>$request->member_id,
            'dps_plan_id'=>$request->dps_plan_id,
            'account_no'=>$accountNo,
            'start_date'=>$startDate,
            'maturity_date'=>$maturityDate,
            'installment_amount'=>$plan->installment_amount,
            'total_installment'=>$plan->duration_month,
            'paid_installment'=>0,
            'status'=>'running',
        ]);
        return redirect()->route('dps-accounts.index')->with('success','DPS Account Open Successfully');
    }
    
    public function destroy($id)
    {
        DpsAccount::findOrFail($id)->delete(); 
        return back() ->with( 'success', 'DPS Account Deleted' );
    }



}