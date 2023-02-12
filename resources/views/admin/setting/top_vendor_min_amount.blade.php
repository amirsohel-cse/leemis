@extends('admin.layout.master.master')
@section('main-content')
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12">
                <h1><strong>Top Vendor Minimum Amount</strong></h1>
                <span>Dashboard</span> <i class="fa fa-angle-right"></i>
                {{--<span>Home Page Setting</span> <i class="fa fa-angle-right"></i>--}}
                <span>Top Vendor</span>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">

                <div class="body">
                    <button id="add_btn" class="btn btn-success btn-round mb-5"  data-toggle="modal" data-target="#addTopVendor"><i class="fa fa-plus"></i>Add/Edit Minimum Top Vendor Amount</button>

                    <div class="table-responsive">
                        <table class="table table-striped table-hover dataTable js-exportable">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Amount</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Amount</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @forelse($others as $other)
                                @if($other->top_vendor_amount != 0)
                                    <tr id="data-id" data-id="{{$other->id}}">
                                        <td id="id">{{$other->id}}</td>
                                        <td id="amount">{{$other->top_vendor_amount}}</td>
                                    </tr>
                                @endif
                            @empty
                                <tr>
                                    <td colspan="3">Not added yet</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{--Add withdraw Modal starts--}}
    <div class="modal ml-5 fade bd-example-modal-lg" tabindex="-1" id="addTopVendor" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel"><strong>Add Minimum Withdraw Amount</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto">
                            <form action="" id="add-withdraw-form" method="post" enctype="multipart/form-data">
                                @csrf
                                <span style="color: red" class="error"></span>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Amount*</strong></span>
                                    </div>
                                    <input type="number" class="form-control" id="formAmount" name="amount" placeholder="Enter Minimum Amount" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                                </div>

                                <button type="submit" class="btn btn-primary theme-bg gradient">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default closeBtn" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
    {{--Add withdraw Modal ends--}}


    {{--Edit withdraw modal starts--}}
    <div class="modal fade bd-example-modal-lg" tabindex="-1" id="editWithdrawModal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel"><strong>Edit Minimum Withdraw Amount</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto">
                            <form action="" id="edit-withdraw-form" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Amount*</strong></span>
                                    </div>
                                    <input type="number" class="form-control" id="edit-amount" name="amount" placeholder="Enter Minimum Amount" aria-label="Default" aria-describedby="inputGroup-sizing-default" required>
                                    <input type="text" id="withdraw-id" name="id" hidden>

                                </div>

                                <button type="submit" class="btn btn-primary theme-bg gradient">Update Withdraw</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default closeBtn" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{--Edit withdraw modal ends--}}

@endsection

@section('minimum-withdraw-scripts')

    <script src="{{asset('/backend/js/topvendor.js')}}"></script>

@endsection
