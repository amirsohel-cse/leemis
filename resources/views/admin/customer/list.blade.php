@extends('admin.layout.master.master')

@section('main-content')

    <div class="row my-4">
        <div class="col-md-12">
            <h3><b>Customer</b></h3>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-12">
            <div class="card">
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>Join Date</th>
                                    <th>Customer Name</th>
                                    <th>Customer Phone</th>
                                    <th>Customer Email</th>
                                    <th>Customer Address</th>
                                    <th>Status</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @dd($vendors) --}}
                                @forelse($customer as $row)
                                    <tr>
                                        <td>{{ $row->created_at->format('d-m-Y') }}</td>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->phone }}</td>
                                        <td>{{ $row->email }}</td>
                                        <td>{{ $row->address }}</td>

                                        <td>
                                            <select name="" class="theme-bg" data-id="{{ $row->id }}"
                                                id="selectStatus">
                                                <option value="1" {{ $row->status == 1 ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ $row->status == 0 ? 'selected' : '' }}>Deactive
                                                </option>
                                            </select>
                                        </td>
                                        <td>
                                            <button data-id="{{$row->id}}" data-toggle="modal" data-target="#editVendorModal" class="btn btn-primary btn-round mr-1 editBtn" style="cursor: pointer" type="button"><i class="fa fa-edit"></i> Edit</button>

                                            <button data-id="{{$row->id}}" class="btn btn-danger btn-round deleteBtn" style="cursor: pointer" type="submit"><i class="fa fa-trash"></i></button>

                                        </td>
                                    @empty
                                        <td colspan="5" class="text-center">No data Available</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>


     {{--Edit Vendor modal starts--}}
     <div class="modal fade bd-example-modal-lg" tabindex="-1" id="editVendorModal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel">EDIT CUSTOMER</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto">
                            <form action="" id="edit-vendor-form" method="post">
                                @csrf
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default">Customer Name*</span>
                                    </div>
                                    <input type="text" class="form-control" id="edit-name" name="name" aria-label="Default" aria-describedby="inputGroup-sizing-default" required>
                                </div>

                                {{--vendor id input file--}}
                                <input type="text" id="vendor-id" name="id" hidden>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default">Phone*</span>
                                    </div>
                                    <input type="text" class="form-control" id="edit-phone" name="phone" aria-label="Default" aria-describedby="inputGroup-sizing-default" required>
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default">Email*</span>
                                    </div>
                                    <input type="email" class="form-control" id="edit-email" name="email" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                                </div>
                                
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default">Address*</span>
                                    </div>
                                    <input type="text" class="form-control" id="edit-address" name="address" aria-label="Default" aria-describedby="inputGroup-sizing-default" required>
                                </div>

                                <button type="submit" class="btn btn-primary theme-bg gradient">Update update</button>
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
    {{--Edit Vendor modal ends--}}
    @endsection


    @section('page-stylesheet')
    <!--<link rel="stylesheet" href="{{ asset('/backend/assets/css/nice-select.css') }}">-->

@endsection
@section('page-scripts')
    <!--<script src="{{ asset('/backend/assets/js/jquery.nice-select.js') }}"></script>-->
    <script !src="">
        // $(document).ready(function() {
        //     $('select').niceSelect();
        // });
    </script>
    <script src="{{ asset('/backend/js/customer.js') }}"></script>

@endsection
