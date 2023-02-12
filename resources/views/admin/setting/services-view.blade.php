@extends('admin.layout.master.master')
@section('main-content')
<div class="block-header">
    <div class="row clearfix">
        <div class="col-lg-8 col-md-12 col-sm-12">
            <h1><strong>Services</strong></h1>
            <span>Dashboard</span> <i class="fa fa-angle-right"></i>
            <span>Home Page Setting</span> <i class="fa fa-angle-right"></i>
            <span>Services</span>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">

            <div class="body">
                <button class="btn btn-success btn-round mb-5"  data-toggle="modal" data-target="#addServiceModal"><i class="fa fa-plus"></i>Add Service</button>

                <div class="table-responsive">
                    <table class="table table-striped table-hover dataTable js-exportable">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Details</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Title</th>
                                <th>Details</th>
                                <th>Options</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @forelse($services as $row)
                                <tr data-id="{{$row->id}}">
                                    <td>{{$row->title}}</td>
                                    <td>{{$row->details}}</td>
                                    <td>
                                        <button data-id="{{$row->id}}" data-toggle="modal" data-target="#editServiceModal" class="btn btn-primary btn-round mr-1 editBtn" style="cursor: pointer" type="button"><i class="fa fa-edit"></i> Edit</button>
                                        <button data-id="{{$row->id}}" class="btn btn-danger btn-round deleteBtn" style="cursor: pointer" type="submit"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                                @empty
                                    <td colspan="5" class="text-center">No data Available</td>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


{{--Add Service Modal starts--}}
    <div class="modal ml-5 fade bd-example-modal-lg" tabindex="-1" id="addServiceModal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel"><strong>ADD NEW SERVICE</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto">
                            <form action="" id="add-service-form" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Title*</strong></span>
                                    </div>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" aria-label="Default" aria-describedby="inputGroup-sizing-default" required>
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Details*</strong></span>
                                    </div>
                                    <input type="text" class="form-control" id="details" name="details" placeholder="Enter Details" aria-label="Default" aria-describedby="inputGroup-sizing-default" required>
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
{{--Add Service Modal ends--}}


{{--Edit Service modal starts--}}
    <div class="modal fade bd-example-modal-lg" tabindex="-1" id="editServiceModal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel"><strong>EDIT SERVICE</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto">
                            <form action="" id="edit-service-form" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Title*</strong></span>
                                    </div>
                                    <input type="text" class="form-control" id="edit-title" name="title" placeholder="Enter Title" aria-label="Default" aria-describedby="inputGroup-sizing-default" required>
                                </div>

                                {{--brand id input file--}}
                                <input type="text" id="service-id" name="id" hidden>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-default"><strong>Details*</strong></span>
                                    </div>
                                    <input type="text" class="form-control" id="edit-details" name="details" placeholder="Enter Details" aria-label="Default" aria-describedby="inputGroup-sizing-default" required>
                                </div>
                             

                                <button type="submit" class="btn btn-primary theme-bg gradient">Update Service</button>
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
{{--Edit brand modal ends--}}

@endsection

@section('page-scripts')
    
    <script src="{{asset('/backend/js/services.js')}}"></script>

@endsection