<?php

namespace App\Http\Controllers;

use App\Models\IncomeExpense;
use App\Models\FundAccount;
use App\Models\FundTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class IncomeExpenseController extends Controller
{

    public function index()
    {
        $items = IncomeExpense::latest()
            ->paginate(15);


        return view(
            'income_expenses.index',
            compact('items')
        );
    }
    public function create()
    {
        return view(
            'income_expenses.create'
        );
    }
    public function store(Request $request)
    {

        $request->validate([

            'type'=>'required',
            'category'=>'required',
            'amount'=>'required|numeric|min:1',
            'date'=>'required|date',
            'payment_method'=>'required'

        ]);
        DB::transaction(function() use($request){
            $item = IncomeExpense::create([
                'type'=>$request->type,
                'category'=>$request->category,
                'amount'=>$request->amount,
                'date'=>$request->date,
                'payment_method'=>$request->payment_method,
                'note'=>$request->note,
                'created_by'=>auth()->id(),
            ]);
            $fundAccount = FundAccount::where('is_default',true)
                ->where('status',true)
                ->first();
            if(!$fundAccount)
            {
                throw new \Exception(
                    'Default Fund Account not found.'
                );
            }
            if($request->type == 'income')
            {
                $newBalance = $fundAccount->current_balance + $request->amount;
                $drCr = 'credit';
 
            }
            else
            {
 
                if(
                    $fundAccount->current_balance
                    <
                    $request->amount
                )
                {

                    throw new \Exception(
                        'Insufficient Fund Balance.'
                    );

                }



                $newBalance =
                    $fundAccount->current_balance
                    -
                    $request->amount;



                $drCr = 'debit';


            }

            $fundAccount->update([

                'current_balance'=>$newBalance

            ]);

            FundTransaction::create([


                'fund_account_id'=>$fundAccount->id,


                'transaction_date'=>$request->date,


                'type'=>$request->type,


                'dr_cr'=>$drCr,


                'amount'=>$request->amount,


                'balance_after'=>$newBalance,


                'reference_type'=>'IncomeExpense',


                'reference_id'=>$item->id,


                'remarks'=>$request->category,


                'created_by'=>auth()->id(),


            ]);




        }); 
        return redirect() ->route('income-expenses.index') ->with( 'success', 'Transaction created successfully' );

    }
 
     public function edit($id)
    {

        $item = IncomeExpense::findOrFail($id);


        return view(
            'income_expenses.edit',
            compact('item')
        );

    }






    public function update(Request $request,$id)
    {

        $item = IncomeExpense::findOrFail($id);


        $request->validate([

            'category'=>'required',
            'amount'=>'required|numeric',
            'date'=>'required|date'

        ]);



        $item->update([


            'category'=>$request->category,

            'amount'=>$request->amount,

            'date'=>$request->date,

            'payment_method'=>$request->payment_method,

            'note'=>$request->note,


        ]);



        return redirect()

            ->route('income-expenses.index')

            ->with(
                'success',
                'Updated successfully'
            );


    }
 
    public function destroy($id)
    {

        IncomeExpense::findOrFail($id)
            ->delete();



        return back()

            ->with(
                'success',
                'Deleted successfully'
            );

    }


}