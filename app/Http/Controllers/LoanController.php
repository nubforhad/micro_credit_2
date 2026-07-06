<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Member;
use App\Models\LoanProduct;
use App\Models\LoanInstallment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::with(['member', 'loanProduct'])
            ->latest()
            ->paginate(10);

        return view('modules.loan.index', compact('loans'));
    }

    public function create()
    {
        $members = Member::where('status', 1)->get();
        $products = LoanProduct::where('status', 1)->get();

        return view('modules.loan.create', compact('members', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'member_id'       => 'required|exists:members,id',
            'loan_product_id' => 'required|exists:loan_products,id',
            'amount'          => 'required|numeric|min:1',
            'start_date'      => 'nullable|date',
            'note'            => 'nullable|string',
        ]);

        $product = LoanProduct::findOrFail($request->loan_product_id);

        // Flat Interest
        $interest = ($request->amount * $product->interest_rate * $product->duration) / 100;

        $totalPayable =
            $request->amount +
            $interest +
            $product->processing_fee +
            $product->insurance_fee;

        Loan::create([
            'member_id'       => $request->member_id,
            'loan_product_id' => $product->id,
            'loan_no'         => 'LN-' . time(),
            'amount'          => $request->amount,
            'total_payable'   => $totalPayable,
            'status'          => 'pending',
            'start_date'      => $request->start_date,
            'note'            => $request->note,
            'created_by'      => auth()->id(),
        ]);

        return redirect()
            ->route('loan.index')
            ->with('success', 'Loan Created Successfully');
    }

    public function show($id)
    {
        $loan = Loan::with(['member', 'loanProduct'])
            ->findOrFail($id);

        return view('modules.loan.show', compact('loan'));
    }

    public function edit($id)
    {
        $loan = Loan::findOrFail($id);

        $members = Member::where('status', 1)->get();
        $products = LoanProduct::where('status', 1)->get();

        return view(
            'modules.loan.edit',
            compact(
                'loan',
                'members',
                'products'
            )
        );
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'member_id'       => 'required|exists:members,id',
            'loan_product_id' => 'required|exists:loan_products,id',
            'amount'          => 'required|numeric|min:1',
            'start_date'      => 'nullable|date',
            'note'            => 'nullable|string',
        ]);

        $loan = Loan::findOrFail($id);

        $product = LoanProduct::findOrFail($request->loan_product_id);

        $interest = ($request->amount * $product->interest_rate * $product->duration) / 100;

        $totalPayable =
            $request->amount +
            $interest +
            $product->processing_fee +
            $product->insurance_fee;

        $loan->update([
            'member_id'       => $request->member_id,
            'loan_product_id' => $product->id,
            'amount'          => $request->amount,
            'total_payable'   => $totalPayable,
            'start_date'      => $request->start_date,
            'note'            => $request->note,
        ]);

        return redirect()
            ->route('loan.index')
            ->with('success', 'Loan Updated Successfully');
    }

    public function destroy($id)
    {
        Loan::findOrFail($id)->delete();

        return redirect()
            ->route('loan.index')
            ->with('success', 'Loan Deleted Successfully');
    }

    public function approve($id)
    {
        $loan = Loan::with('loanProduct')->findOrFail($id);

        if ($loan->status != 'pending') {
            return back()->with('error', 'Loan already processed.');
        }

        $loan->status = 'running';

        if (!$loan->start_date) {
            $loan->start_date = now();
        }

        $loan->save();

        $duration = $loan->loanProduct->duration;

        $installmentAmount = round(
            $loan->total_payable / $duration,
            2
        );

        for ($i = 1; $i <= $duration; $i++) {

            $dueDate = Carbon::parse($loan->start_date);

            switch ($loan->loanProduct->installment_type) {

                case 'daily':
                    $dueDate->addDays($i);
                    break;

                case 'weekly':
                    $dueDate->addWeeks($i);
                    break;

                default:
                    $dueDate->addMonths($i);
                    break;
            }

            LoanInstallment::create([
                'loan_id'        => $loan->id,
                'installment_no' => $i,
                'due_date'       => $dueDate,
                'amount'         => $installmentAmount,
            ]);
        }

        return back()->with(
            'success',
            'Loan Approved & Installments Generated Successfully.'
        );
    }
}