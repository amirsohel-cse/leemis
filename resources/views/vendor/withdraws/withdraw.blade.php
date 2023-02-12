@extends('vendor.layout.master.master')
@section('main-content')

<div class="block-header">
    <div class="row clearfix">
        <div class="col-lg-8 col-md-12 col-sm-12">
            <h1><strong>My Withdraws</strong></h1>
            <span>Dashboard</span> <i class="fa fa-angle-right"></i>
            <span>My Withdraws</span>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
            <button class="btn btn-success btn-round"  id="withdrawBtn" data-toggle="modal" data-target="#withdrawModal"><i class="fa fa-plus"></i>Withdraw Now</button>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover dataTable js-exportable">
                        <thead>
                            <tr>
                                <th>Withdraw Date</th>
                                <th>Method</th>
                                <th>Account</th>
                                <th>Amount</th>
                                <th>Status</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $data['withdraws'] as $row)
                            <tr>
                                <td>{{$row->created_at->format('d-M-Y')}}</td>
                                <td>{{$row->method}}</td>
                                <td>{{$row->account_no}}</td>
                                <td>{{$row->amount}}</td>
                                <td>
                                @if ($row->status == 'Pending')
                                    <span class="badge bg-warning text-white">Pending</span>
                                @elseif($row->status == 'Processing')
                                    <span class="badge bg-info text-white">Processing</span>
                                @elseif($row->status == 'Completed')
                                    <span class="badge bg-success text-white">Completed</span>
                                    @elseif($row->status == 'Declined')
                                    <span class="badge bg-danger text-white">Declined</span>
                                @endif
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                            <th>Withdraw Date</th>
                                <th>Method</th>
                                <th>Account</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
{{--Add Withdraw Modal starts--}}
    <div style="overflow-y:auto" class="modal ml-1 fade bd-example-modal-md" tabindex="-1" id="withdrawModal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel"><strong>Withdraw Now</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div>

                        <label class="control-label" for="name"><h4> <span id="curr_bal"><strong>Current Balance :</strong> {{ $data['current_bal']}}</span></h4> </label>

                    </div>

                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto">
                            <form action="" id="add-withdraw-form" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="item form-group">
                                    <label class="control-label col-sm-4" for="name"><strong>Withdraw Method *</strong>

                                    </label>
                                    <div class="col-sm-12">
                                        <select class="form-control" name="method" id="withmethod" required>

                                            <option>Select</option>
                                            <option value="Bank"><strong>Bank</strong></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-sm-12 mt-2" for="amount"><strong>Withdraw Amount *</strong>

                                    </label>
                                    <div class="col-sm-12">
                                        <input id="amount" name="amount" placeholder="Withdraw Amount" class="form-control"  type="number" value="" required>
                                    </div>
                                </div>
                                <strong><span id="amount_error" class="invalid-feedback d-block mb-3" role="alert">
                                </span> </strong>
                                <!------------------------------>
                                <div id="paypal" style="display: none;">

                                    <div class="item form-group">
                                        <label class="control-label col-sm-12" for="name"><strong>Account Email *</strong>

                                        </label>
                                        <div class="col-sm-12">
                                            <input name="acc_email" placeholder="Enter Account Email" class="form-control" value="" type="email">
                                        </div>
                                    </div>

                                </div>
                                <!------------------------------>
                                <div id="bank" style="display: none;">

                                    <div class="item form-group">
                                        <label class="control-label col-sm-12" for="iban"><strong>IBAN/Account No *</strong>

                                        </label>
                                        <div class="col-sm-12">
                                            <input id="iban" name="iban" value="" placeholder="Enter IBAN/Account No" class="form-control" type="text" required>
                                        </div>
                                    </div>

                                    <div class="item form-group">
                                        <label class="control-label col-sm-12" for="acc_name"><strong>Account Holder Name *</strong>

                                        </label>
                                        <div class="col-sm-12">
                                            <input id="acc_name" name="acc_name" value="" placeholder="Enter Account Name" class="form-control" type="text" required>
                                        </div>
                                    </div>

                                    <div class="item form-group">
                                        <label class="control-label col-sm-12" for="name">


                                        <strong>Routing Number*</strong>

                                        </label>
                                        <div class="col-sm-12">
                                            <input id="routing_number" name="routing_number" value="" placeholder="Routing Number" class="form-control" type="text" required>
                                        </div>
                                    </div>

                                    <div class="item form-group">
                                        <label class="control-label col-sm-12" for="name"><strong>Swift Code *</strong>

                                        </label>
                                        <div class="col-sm-12">
                                            <input id="swift" name="swift" value="" placeholder="Enter Swift Code" class="form-control" type="text" required>
                                        </div>
                                    </div>

                                </div>
                                <div class="item form-group">
                                    <label class="control-label col-sm-12" for="name">

                                    <strong> Bank name and Branch *</strong>


                                    </label>
                                    <div class="col-sm-12">
                                        <textarea class="form-control" id="bankname" name="bankname" rows="6" placeholder="Bank name and Branch" required></textarea>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary theme-bg gradient">Make Withdraw</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default closeBtn close"  data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
{{--Add Withdraw Modal ends--}}


@endsection
@section('page-stylesheet')
    <link rel="stylesheet" href="{{asset('/backend/assets/css/nice-select.css')}}">

@endsection
@section('page-scripts')
    <script src="{{asset('/backend/assets/js/jquery.nice-select.js')}}"></script>
    <script !src="">
        // $(document).ready(function () {
        //     $('select').niceSelect();
        // });

    </script>
    <script type="text/javascript">
$("#withdrawModal .close").click(function(){
    $("#bank").hide();
    $("#bank").find('input, select').attr('required',false);
});
$("#withmethod").change(function(){
    var method = $(this).val();
    if(method == "Bank"){

        $("#bank").show();
        $("#bank").find('input, select').attr('required',true);

     }
    if(method != "Bank"){
        $("#bank").hide();
        $("#bank").find('input, select').attr('required',false);
    }
    if(method == ""){
        $("#bank").hide();
        $("#bank").find('input, select').attr('required',false);
    }

})

</script>

@endsection
@section('withdraw-scripts')
    <script src="{{asset('/vendor/js/withdraw.js')}}"></script>
@endsection
