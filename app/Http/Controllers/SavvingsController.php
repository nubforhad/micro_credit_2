<?php

namespace App\Http\Controllers;

use App\Models\Savvings;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class SavvingsController extends Controller
{


    /**
     * Savvings List
     */
    public function index(Request $request)
    {

        $query = Savvings::with('member');


        // Search
        if($request->filled('search')){

            $search = $request->search;


            $query->where(function($q) use ($search){

                $q->where('receipt_no','like',"%{$search}%")

                ->orWhereHas('member',function($member) use ($search){

                    $member->where('name','like',"%{$search}%")
                    ->orWhere('member_no','like',"%{$search}%");

                });

            });

        }

        $savvings = $query->latest()->paginate(15);
        $totalApprovedDeposit = Savvings::where('type', 'deposit')->where('status', 'approved')->sum('amount');
        return view( 'modules.savvings.index',  compact('savvings', 'totalApprovedDeposit'));

    }





    /**
     * Create Form
     */
    public function create()
    {

        $members = Member::latest()->get();
        return view(
            'modules.savvings.create',
            compact('members')
        );

    }
  
  public function store(Request $request)
{
    $request->validate([
        'member_id'       => 'required',
        'type'            => 'required',
        'amount'          => 'required|numeric|min:1',
        'payment_method'  => 'required',
        'date'            => 'required|date'
    ]);


    // Withdraw Balance Check
    if($request->type == 'withdraw')
    {

        $deposit = Savvings::where('member_id',$request->member_id)
            ->where('type','deposit')
            ->where('status','approved')
            ->sum('amount');


        $withdraw = Savvings::where('member_id',$request->member_id)
            ->where('type','withdraw')
            ->where('status','approved')
            ->sum('amount');


        $balance = $deposit - $withdraw;


        if($request->amount > $balance)
        {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Insufficient balance. Current balance is ৳ '.number_format($balance,2)
                );

        }

    }



    // Status based on type
    $status = $request->type == 'withdraw'
        ? 'pending'
        : 'approved';



    Savvings::create([

        'member_id'      => $request->member_id,
        'receipt_no'     => $this->generateReceipt(),
        'type'           => $request->type,
        'status'         => $status,
        'amount'         => $request->amount,
        'payment_method' => $request->payment_method,
        'date'           => $request->date,
        'note'           => $request->note,
        'created_by'     => auth()->id(),

    ]);


    return redirect()
        ->route('savvings.index')
        ->with(
            'success',
            'Savvings created successfully'
        );
}




    /**
     * Show
     */
    public function show($id)
    {
        $savving = Savvings::with('member')
            ->findOrFail($id);
        return view(
            'modules.savvings.show',
            compact('savving')
        );
    }

    /**
     * Edit
     */
    public function edit($id)
    {

        $savving = Savvings::findOrFail($id);


        $members = Member::latest()->get();


        return view(
            'modules.savvings.edit',
            compact(
                'savving',
                'members'
            )
        );

    }





    /**
     * Update
     */
    public function update(Request $request,$id)
    {


        $savving = Savvings::findOrFail($id);



        $request->validate([


            'member_id'=>'required',

            'type'=>'required',

            'amount'=>'required|numeric|min:1',

            'payment_method'=>'required',

            'date'=>'required|date'


        ]);



        $savving->update([


            'member_id'=>$request->member_id,

            'type'=>$request->type,

            'amount'=>$request->amount,

            'payment_method'=>$request->payment_method,

            'date'=>$request->date,

            'note'=>$request->note,


        ]);



        return redirect()

            ->route('savvings.index')

            ->with(
                'success',
                'Savvings updated successfully'
            );

    }





    /**
     * Delete
     */
    public function destroy($id)
    {

        Savvings::findOrFail($id)->delete();



        return back()

            ->with(
                'success',
                'Savvings deleted successfully'
            );

    }





    /**
     * Auto Receipt Generate
     */
    private function generateReceipt()
    {


        $last = Savvings::latest()->first();



        if($last){

            $number = $last->id + 1;

        }else{

            $number = 1;

        }



        return 'SV-'.date('Ymd').'-'.str_pad(
            $number,
            5,
            '0',
            STR_PAD_LEFT
        );


    }

    public function receipt($id)
    {
        $savving = Savvings::with([
            'member',
            'creator'
        ])
        ->findOrFail($id);
        return view( 'modules.savvings.receipt', compact('savving') );

    }

    public function ledger($member_id)
    {
        $member = Member::findOrFail($member_id);
        $transactions = Savvings::where('member_id',$member_id)
            ->orderBy('date','asc')
            ->orderBy('id','asc')
            ->get();
        $balance = 0;
        foreach($transactions as $transaction){
            if($transaction->type == 'deposit'){
                $balance += $transaction->amount;
            }
            else{
                $balance -= $transaction->amount;
            }
            $transaction->balance = $balance;
        }

        return view( 'modules.savvings.ledger', compact( 'member', 'transactions'));
    }

    private function getBalance($member_id)
    {

        $deposit = Savvings::where('member_id',$member_id)
            ->where('type','deposit')
            ->where('status','approved')
            ->sum('amount');



        $withdraw = Savvings::where('member_id',$member_id)
            ->where('type','withdraw')
            ->where('status','approved')
            ->sum('amount');



        return $deposit - $withdraw;

    }

    public function withdraw(Request $request)
{
    $request->validate([
        'member_id'=>'required',
        'amount'=>'required|numeric|min:1',
        'date'=>'required'
    ]);
    $balance = $this->getBalance(
        $request->member_id
    );
    if($request->amount > $balance)
    {
        return back()
        ->with(
            'error',
            'Insufficient saving balance'
        );
    }
    Savvings::create([
        'member_id'=>$request->member_id,
        'receipt_no'=>$this->generateReceipt(),
        'type'=>'withdraw',
        'status'=>'pending',
        'amount'=>$request->amount,
        'payment_method'=>$request->payment_method,
        'date'=>$request->date,
        'note'=>$request->note,
        'created_by'=>auth()->id()


    ]);
    return back()
    ->with(
        'success',
        'Withdraw request submitted'
    );


}

    public function withreq(){
        $requests = Savvings::with('member')
            ->where('type','withdraw')
            ->where('status','pending')
            ->latest()
            ->paginate(15);
        return view('modules.savvings.withdrawRequest',  compact('requests'));
    }


    public function withdrawRequest()
    {

        $requests = Savvings::with('member')
            ->where('type','withdraw')
            ->where('status','pending')
            ->latest()
            ->paginate(15);

        return view('modules.savvings.withdrawRequest',  compact('requests'));

    }
    public function withdrawApprove($id)
    {
        $savving = Savvings::findOrFail($id);
        if($savving->status != 'pending')
        {
            return back()->with('error','Already processed');

        }

        $savving->update(['status'=>'approved','approved_date'=>now(), 'approved_by'=>auth()->id()]);

        return back()
        ->with(
            'success',
            'Withdraw approved successfully'
        );


    }


    public function withdrawReject($id)
    {
        $savving = Savvings::findOrFail($id);

        if($savving->status != 'pending'){
            return back()->with('error','Already processed');
        }

        $savving->update([
            'status' => 'rejected',
            'approved_date' => now(),
            'approved_by' => auth()->id(),
        ]);

        return back()->with(
            'success',
            'Withdraw rejected successfully'
        );
    }

   public function summary1(Request $request)
{
    $query = Savvings::query();


    // Date Filter
    if($request->filled('from_date') && $request->filled('to_date')){

        $query->whereBetween('date',[
            $request->from_date,
            $request->to_date
        ]);
    } 
    // Today Filter
    if($request->filter == 'today'){

        $query->whereDate(
            'date',
            today()
        );
    }
    $totalApprovedDeposit = (clone $query)
        ->where('type','deposit')
        ->where('status','approved')
        ->sum('amount');

    $totalApprovedWithdraw = (clone $query)
        ->where('type','withdraw')
        ->where('status','approved')
        ->sum('amount');

    $totalPendingWithdraw = (clone $query)
        ->where('type','withdraw')
        ->where('status','pending')
        ->sum('amount');

    $totalRejectedWithdraw = (clone $query)
        ->where('type','withdraw')
        ->where('status','rejected')
        ->sum('amount');

    $currentBalance =   $totalApprovedDeposit - $totalApprovedWithdraw;
    return view(
        'modules.summary',
        compact(
            'totalApprovedDeposit',
            'totalApprovedWithdraw',
            'totalPendingWithdraw',
            'totalRejectedWithdraw',
            'currentBalance'
        )
    );
}

    public function memberSummary1(Request $request)
{
    $query = Member::query();


    // Search Member No / Name
    if($request->filled('search')){

        $search = $request->search;

        $query->where(function($q) use($search){

            $q->where('member_no','like',"%{$search}%")
              ->orWhere('name','like',"%{$search}%");

        });

    }


    $members = $query

    ->withSum([
        'savvings as total_deposit' => function($q){
            $q->where('type','deposit')
              ->where('status','approved');
        }
    ],'amount')


    ->withSum([
        'savvings as total_withdraw' => function($q){
            $q->where('type','withdraw')
              ->where('status','approved');
        }
    ],'amount')


    ->withSum([
        'savvings as pending_withdraw' => function($q){
            $q->where('type','withdraw')
              ->where('status','pending');
        }
    ],'amount')


    ->withSum([
        'savvings as rejected_withdraw' => function($q){
            $q->where('type','withdraw')
              ->where('status','rejected');
        }
    ],'amount')


    ->latest()
    ->paginate(15);


    return view(
        'modules.member-summary',
        compact('members')
    );
}



public function memberLedger($member_id)
{
    $member = Member::findOrFail($member_id);
    $transactions = Savvings::where('member_id',$member_id)
        ->orderBy('date','asc')
        ->orderBy('id','asc')
        ->get();
    $balance = 0;
    foreach($transactions as $transaction){


        if(
            $transaction->type == 'deposit' 
            && 
            $transaction->status == 'approved'
        ){
            $balance += $transaction->amount;
        }
        elseif(
            $transaction->type == 'withdraw'
            &&
            $transaction->status == 'approved'
        ){
            $balance -= $transaction->amount;
        }
        $transaction->balance = $balance;
    } 
    return view( 'modules.member-ledger', compact( 'member', 'transactions' ) );
}

}