@extends('admin.layout.master.master')


@section('main-content')

    <div class="row my-4">
        <div class="col-md-12">
            <h3><b>Vendors</b></h3>
        </div>

    </div>
     @if(Session::get('success'))
        <div class="alert text-white container" style="background: #3daa1b;">
            {{ Session::get('success') }}
        </div>
        @endif
    <div class="row clearfix">
        <div class="col-12">
            <div class="card">
                <div class="body ">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover dataTable js-exportable ">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Vendor Name</th>
                                    <th>Vendor Email</th>
                                    <th>Vendor Phone</th>
                                    <th>Shop Name</th>
                                    <th>Vendor Address</th>
                                    <th>Date</th>
                                    <th>Feature</th>
                                    <th>Status</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody class="table-append">
                                {{-- @dd($vendors) --}}
                                @forelse($vendors as $key => $row)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->email }}
                                            <input type="hidden" name="email" value="{{ $row->email }}">
                                        </td>
                                        <td>{{ $row->phone }}</td>
                                        <td>{{ $row->shop_name }}</td>
                                        <td>{{ $row->address }}</td>
                                        <td>{{ $row->created_at->format('d-m-Y') }}</td>
                                        <td>
                                            <span data-id="{{ $row->id }}"
                                                class="badge {{ $row->feature == 1 ? 'badge-success' : 'badge-danger' }} yesNo"
                                                style="cursor: pointer">{{ $row->feature == 1 ? 'YES' : 'NO' }}</span>
                    
                    
                                        </td>
                                        <td>
                                            <span data-id="{{ $row->id }}"
                                                class="badge {{ $row->s_status == 1 ? 'badge-success' : 'badge-danger' }} selectStatus"
                                                style="cursor: pointer">{{ $row->s_status == 1 ? 'ACTIVE' : 'DEACTIVE' }}</span>
                    
                                        </td>
                    
                                        <td>
                                            <button data-id="{{ $row->id }}" data-toggle="modal"
                                                data-target="#editVendorModal"
                                                class="btn btn-primary btn-round mr-1 editBtn" style="cursor: pointer"
                                                type="button"><i class="fa fa-edit"></i> Edit</button>
                    
                                            <button data-id="{{ $row->id }}" data-toggle="modal" id="email"
                                                data-target="#emailModal" class="btn btn-warning btn-round mr-1 editBtn"
                                                style="cursor: pointer" type="button"><i class="fa fa-edit"></i>
                                                Email</button>
                    
                    
                    
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


    {{-- Edit Vendor modal starts --}}
    <div class="modal fade bd-example-modal-lg" tabindex="-1" id="editVendorModal" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel"><strong>EDIT VENDOR</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto">
                            <form action="" id="edit-vendor-form" method="post">
                                @csrf
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Vendor
                                                Name*</strong></span>
                                    </div>
                                    <input type="text" class="form-control" id="edit-name" name="name"
                                        placeholder="Enter Name" aria-label="Default"
                                        aria-describedby="inputGroup-sizing-default" required>
                                </div>

                                {{-- vendor id input file --}}
                                <input type="text" id="vendor-id" name="id" hidden>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"
                                            id="inputGroup-sizing-default"><strong>Phone*</strong></span>
                                    </div>
                                    <input type="text" class="form-control" id="edit-phone" name="phone"
                                        placeholder="Enter Phone Number" aria-label="Default"
                                        aria-describedby="inputGroup-sizing-default" required>
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"
                                            id="inputGroup-sizing-default"><strong>Email*</strong></span>
                                    </div>
                                    <input type="email" class="form-control" id="edit-email" name="email"
                                        aria-label="Default" placeholder="Enter Email Address"
                                        aria-describedby="inputGroup-sizing-default" required>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Shop
                                                Name*</strong></span>
                                    </div>
                                    <input type="text" class="form-control" id="edit-shop_name" name="shop_name"
                                        placeholder="Enter Shop Name" aria-label="Default"
                                        aria-describedby="inputGroup-sizing-default" required>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"
                                            id="inputGroup-sizing-default"><strong>Address*</strong></span>
                                    </div>
                                    <input type="text" class="form-control" id="edit-address" name="address"
                                        placeholder="Enter Address" aria-label="Default"
                                        aria-describedby="inputGroup-sizing-default" required>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"
                                            id="inputGroup-sizing-default"><strong>Date</strong></span>
                                    </div>
                                    <input type="text" class="form-control" id="edit-date" name="date"
                                        aria-label="Default" aria-describedby="inputGroup-sizing-default" readonly>
                                </div>

                                <button type="submit" class="btn btn-primary theme-bg gradient">Update Vendor</button>
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
    {{-- Edit Vendor modal ends --}}



    <div class="modal fade bd-example-modal-lg" tabindex="-1" id="emailModal" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel"><strong>EMAIL VENDOR</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto">

                            <form method="post" action="{{ route('vendorEmail') }}">


                                @csrf
                                <input type="hidden" name="id" id="">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"
                                            id="inputGroup-sizing-default"><strong>Subject*</strong></span>
                                    </div>
                                    <input type="text" class="form-control" id="edit-name" placeholder="Enter Subject"
                                        name="sub" aria-label="Default" aria-describedby="inputGroup-sizing-default"
                                        required>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default">Massage*</span>
                                    </div>
                                    <input type="text" class="form-control" id="edit-name" name="msg"
                                        placeholder="Compose Email" aria-label="Default"
                                        aria-describedby="inputGroup-sizing-default" required>
                                </div>

                                <input type="submit" class="btn btn-primary">


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
    <script src="{{ asset('/backend/js/vendor.js') }}"></script>
    <script src="https://unpkg.com/dayjs@1.8.21/dayjs.min.js"></script>

    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
    <script>
        $(document).on('click', '#email', function(e) {

            e.preventDefault();
            let id = $(this).attr('data-id');
            $('#emailModal input[name="id"]').val(id);
        })
    </script>

@endsection
