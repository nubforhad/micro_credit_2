@extends('layouts.app')
@section('content')
<h4 class="mb-3">
   Withdraw Request
</h4>
<div class="card shadow-sm">
   <div class="card-body">
      <table class="table table-bordered">
         <thead class="table-dark">
            <tr>
               <th>#</th>
               <th>Member</th>
               <th>Amount</th>
               <th>Date</th>
               <th>Status</th>
               <th>Action</th>
            </tr>
         </thead>
         <tbody>
            @forelse($requests as $key=>$item)
            <tr>
               <td>
                  {{ $requests->firstItem()+$key }}
               </td>
               <td>
                  {{ $item->member->name }}
                  <br>
                  <small>
                  {{ $item->member->member_no }}
                  </small>
               </td>
               <td>
                  ৳ {{ number_format($item->amount,2) }}
               </td>
               <td>
                  {{ $item->date }}
               </td>
               <td>
                  <span class="badge bg-warning">
                  Pending
                  </span>
               </td>
               <td>
                  <form action="{{ route('savvings.withdraw.approve',$item->id) }}"
                     method="POST">
                     @csrf
                     @method('PUT')
                     <button class="btn btn-success btn-sm">
                     Approve
                     </button>
                  </form>
               </td>
            </tr>
            @empty
            <tr>
               <td colspan="6" class="text-center">
                  No Withdraw Request
               </td>
            </tr>
            @endforelse
         </tbody>
      </table>
      {{ $requests->links() }}
   </div>
</div>
@endsection