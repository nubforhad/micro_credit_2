@extends('layouts.app')
@section('content')
<div class="container-fluid">
   <div class="d-flex justify-content-between align-items-center mb-4">
      <div>
         <h3 class="fw-bold">
            <i class="bx bx-book text-primary"></i>
            Member Ledger
         </h3>
         <p class="text-muted mb-0">
            Complete Loan Transaction History
         </p>
      </div>
      <a href="{{ route('member.index') }}"
         class="btn btn-secondary">
      <i class="bx bx-arrow-back"></i>
      Back
      </a>
   </div>
   {{-- Member Card --}}
   <div class="card shadow border-0 mb-4">
      <div class="card-body">
         <div class="row">
            <div class="col-md-4">
               <h5 class="text-primary">
                  Member Information
               </h5>
               <hr>
               <p>
                  <b>Member No:</b>
                  {{ $member->member_no }}
               </p>
               <p>
                  <b>Name:</b>
                  {{ $member->name }}
               </p>
               <p>
                  <b>Phone:</b>
                  {{ $member->phone ?? '-' }}
               </p>
            </div>
            <div class="col-md-8">
               <div class="row">
                  <div class="col-md-4">
                     <div class="card bg-light">
                        <div class="card-body text-center">
                           <h6>Total Loan</h6>
                           <h3>  {{ $member->loans->count() }}      </h3>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="card bg-light">
                        <div class="card-body text-center">
                           <h6>Total Paid</h6>
                           <h3 class="text-success">
                              ৳ {{ number_format(
                              $member->loans->flatMap->payments->sum('amount'),
                              2
                              ) }}
                           </h3>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="card bg-light">
                        <div class="card-body text-center">
                           <h6>Total Due</h6>
                           <h3 class="text-danger">
                              ৳ {{ number_format(
                              $member->loans->sum('total_payable')
                              -
                              $member->loans->flatMap->payments->sum('amount'),
                              2
                              ) }}
                           </h3>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   {{-- Loan History --}}
   <div class="card shadow border-0">
      <div class="card-header bg-primary text-white">
         <h5 class="mb-0">
            Loan History
         </h5>
      </div>
      <div class="card-body">
         <table class="table table-bordered">
            <thead class="table-dark">
               <tr>
                  <th>
                     Loan No
                  </th>
                  <th>
                     Amount
                  </th>
                  <th>
                     Total Payable
                  </th>
                  <th>
                     Status
                  </th>
                  <th>
                     Payment History
                  </th>
               </tr>
            </thead>
            <tbody>
               @foreach($member->loans as $loan)
               <tr>
                  <td>
                     {{ $loan->loan_no }}
                  </td>
                  <td>
                     ৳ {{ number_format($loan->amount,2) }}
                  </td>
                  <td>
                     ৳ {{ number_format($loan->total_payable,2) }}
                  </td>
                  <td>
                     <span class="badge bg-success">
                     {{ ucfirst($loan->status) }}
                     </span>
                  </td>
                  <td>
                     <a href="{{ route('loan.payment.show',$loan->id) }}"
                        class="btn btn-sm btn-info">
                     View
                     </a>
                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
   </div>


   @foreach($member->loans as $loan)
<div class="card shadow-sm mt-4">
   <div class="card-header bg-dark text-white">
      <h5 class="mb-0">
         Loan No:
         {{ $loan->loan_no }}
      </h5>
   </div>
   <div class="card-body">
      <div class="row mb-3">
         <div class="col-md-4">
            <strong>
            Loan Amount
            </strong>
            <br>
            ৳ {{ number_format($loan->amount,2) }}
         </div>
         <div class="col-md-4">
            <strong>
            Total Payable
            </strong>
            <br>
            ৳ {{ number_format($loan->total_payable,2) }}
         </div>
         <div class="col-md-4">
            <strong>
            Status
            </strong>
            <br>
            <span class="badge bg-success">
            {{ ucfirst($loan->status) }}
            </span>
         </div>
      </div>
      <table class="table table-bordered">
         <thead class="table-light">
            <tr>
               <th>
                  Installment
               </th>
               <th>
                  Due Date
               </th>
               <th>
                  Amount
               </th>
               <th>
                  Paid
               </th>
               <th>
                  Status
               </th>
            </tr>
         </thead>
         <tbody>
            @foreach($loan->installments as $installment)
            <tr>
               <td>
                  #{{ $installment->installment_no }}
               </td>
               <td>
                  {{ \Carbon\Carbon::parse($installment->due_date)->format('d M Y') }}
               </td>
               <td>
                  ৳ {{ number_format($installment->amount,2) }}
               </td>
               <td>
                  ৳ {{ number_format($installment->paid_amount,2) }}
               </td>
               <td>
                  @if($installment->status=='paid')
                  <span class="badge bg-success">
                  Paid
                  </span>
                  @elseif($installment->status=='partial')
                  <span class="badge bg-warning">
                  Partial
                  </span>
                  @else
                  <span class="badge bg-danger">
                  Unpaid
                  </span>
                  @endif
               </td>
            </tr>
            @endforeach
         </tbody>
      </table>
   </div>
</div>
@endforeach

</div>
@endsection