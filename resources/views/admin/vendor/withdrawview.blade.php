@extends('admin.layout.master.master')
@section('main-content')
<div class="block-header">
    <div class="row clearfix">
        <div class="col-lg-8 col-md-12 col-sm-12">
            <h1>Withdraw Details</h1>
            <span>Dashboard</span> <i class="fa fa-angle-right"></i>
            <span>Vendor</span> <i class="fa fa-angle-right"></i>
            <span>Withdraw</span> <i class="fa fa-angle-right"></i>
            <span>Withdraw Details</span>
        </div>
    </div>
</div>

<div class="card">
  <div class="row clearfix mb-3 mt-2 mr-2">
    <div class="col-md-12 text-right">
        <button onclick="printDiv('print')" class="btn btn-success">Print Details</button>
    </div>
</div> 
<div class="container-fluid mb-3 mt-2" id="print">
  <center>
    <h4>Withdraw Details</h4>
  </center>
  <hr>
    @if($withdraw->isNotEmpty())
    <div class="row">
      <div class="col-md-4">Vendor Name</div>
      <div class="col-md-6 ml-auto">{{isset($withdraw[0]->vendor->name) ? $withdraw[0]->vendor->name : ''}}</div>
    </div><hr>
    <div class="row">
      <div class="col-md-4">Shop Name</div>
      <div class="col-md-6 ml-auto">{{isset($withdraw[0]->vendor->shop_name) ? $withdraw[0]->vendor->shop_name : ''}}</div>
    </div><hr>
    <div class="row">
      <div class="col-md-4">Email</div>
      <div class="col-md-6 ml-auto">{{isset($withdraw[0]->vendor->email) ? $withdraw[0]->vendor->email : ''}}</div>
    </div><hr>
    <div class="row">
      <div class="col-md-4">Phone</div>
      <div class="col-md-6 ml-auto">{{isset($withdraw[0]->vendor->phone) ? $withdraw[0]->vendor->phone : ''}}</div>
    </div><hr>
    <div class="row">
      <div class="col-md-4">Address</div>
      <div class="col-md-6 ml-auto">{{isset($withdraw[0]->vendor->address) ? $withdraw[0]->vendor->address : ''}}</div>
    </div><hr>
    <div class="row">
      <div class="col-md-6">Withdrawal Amount</div>
      <div class="col-md-6 ml-auto">{{isset($withdraw[0]->amount) ? $withdraw[0]->amount : ''}}</div>
    </div><hr>
    <div class="row">
      <div class="col-md-6">Withdrawal Method</div>
      <div class="col-md-6 ml-auto">{{isset($withdraw[0]->method) ? $withdraw[0]->method : ''}}</div>
    </div><hr>
    <div class="row">
      <div class="col-md-4">Account Number</div>
      <div class="col-md-6 ml-auto">{{isset($withdraw[0]->account_no) ? $withdraw[0]->account_no : ''}}</div>
    </div><hr>
    <div class="row">
      <div class="col-md-4">Acoount Name</div>
      <div class="col-md-6 ml-auto">{{isset($withdraw[0]->account_name) ? $withdraw[0]->account_name : ''}}</div>
    </div><hr>
    <div class="row">
      <div class="col-md-4">Swift Code</div>
      <div class="col-md-6 ml-auto">{{isset($withdraw[0]->swift_code) ? $withdraw[0]->swift_code : ''}}</div>
    </div><hr>
    <div class="row">
      <div class="col-md-4">Routing Number</div>
      <div class="col-md-6 ml-auto">{{isset($withdraw[0]->routing_number) ? $withdraw[0]->routing_number : ''}}</div>
    </div><hr>            
    <div class="row">
      <div class="col-md-6">Bank Name & Branch</div>
      <div class="col-md-6 ml-auto">{{isset($withdraw[0]->bank_name) ? $withdraw[0]->bank_name : ''}}</div>
    </div><hr>
    <div class="row">
      <div class="col-md-4">Withdrawal Date</div>
      <div class="col-md-6 ml-auto">{{$withdraw[0]->created_at->format('d-M-Y')}}</div>
    </div><hr>
    <div class="row">
      <div class="col-md-4">Status</div>
      <div class="col-md-6 ml-auto">
        @if ($withdraw[0]->status == 'Pending')
        <span class="badge bg-warning text-white">Pending</span>
    @elseif($withdraw[0]->status == 'Processing')
        <span class="badge bg-info text-white">Processing</span>
    @elseif($withdraw[0]->status =='Completed')
        <span class="badge bg-success text-white">Completed</span>
        @elseif($withdraw[0]->status =='Declined')
        <span class="badge bg-danger text-white">Declined</span>
    @endif
      
      </div>
    </div>
  @endif
  </div>
</div>


<script>
  function printDiv(print) {
     var printContents = document.getElementById(print).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
@endsection