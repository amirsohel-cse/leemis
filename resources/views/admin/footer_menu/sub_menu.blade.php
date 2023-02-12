@extends('admin.layout.master.master')

@section('main-content')
    <link rel="stylesheet" href="{{asset('/backend/assets/vendor/summernote/dist/summernote.min.css')}}">
    <link rel="stylesheet" href="{{asset('/backend/assets/vendor/summernote/dist/summernote-bs4.min.css')}}">
    <style type="text/css">
        textarea.input-field
        {
            width: 100%;
            height: 150px;
        / border-color: Transparent;      /
        }
        .left-area {
            text-align: right;
        }
        .left-area .heading {
            font-size: 16px!important;
            font-weight: 600;
            color: #0d3359;
            margin-bottom: 0px;
            font-family: "Open Sans", sans-serif;
            line-height: 1.2380952380952381;
        }
        .left-area .sub-heading {
            font-size: 12px;
            color: #143250;
        }
        .left-area p {
            margin-bottom: 0px;
            font-size: 16px;
            color: #465541;
            line-height: 1.625;
            -webkit-hyphens: auto;
            -moz-hyphens: auto;
            -ms-hyphens: auto;
            font-family: "Open Sans", sans-serif;
            hyphens: auto;
        }
    </style>
<script src="{{asset('../backend/assets/vendor/jquery/jquery.min.js')}}"></script>
    <div class="container-fluid">

        <div class="card shadow mb-4">
            <div class="card-header py-4">
                <button class="btn btn-success btn-round" id="addMenuBtn" data-toggle="modal" data-target="#addMenuModal"><i class="fa fa-plus"></i>Add Sub Menu</button>
            <!-- <a href="{{ route('sub_menu') }}" style="float: right;" class=" ml-0 font-weight-bold text-primary ">Sub Menu Add

            </a> -->

            </div>

            <div class="card-body">
                <div class="table-responsive">
                    @if(Session::has('message'))

                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ Session::get('message') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <table  class="table table-striped table-bordered  dataTable js-exportable" style="width:100%">
                        <thead>
                        <tr>

                            <th>Menu</th>
                            <th>Status</th>
                            <th>Action</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $key => $data)
                            <tr data-id="{{$data->id}}">

                                <td>{{ $data->sub_menu }}</td>
                                <td>{{ $data->sub_status }}</td>
                                <td>
                                    <button type="button" data-toggle="modal" data-target="#edit-submenu" data-id="{{$data->id}}" style="cursor: pointer" class="btn btn-primary btn-round mr-1 editBtn">
                                        <i class="fa fa-pencil" aria-hidden="true"></i></button>
                                    <button data-id="{{$data->id}}" class="btn btn-danger btn-round Btn_delete" style="cursor: pointer" type="submit"><i class="fa fa-trash"></i></button>
                                </td>

                            </tr>

                        @endforeach


                        </tbody>
                        <tfoot>
                        <tr>

                            <th>Menu</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                    </table>


                </div>
            </div>
        </div>

    </div>


    {{--Add Menu Modal starts--}}
    <div class="modal ml-5 fade bd-example-modal-lg" tabindex="-1" id="addMenuModal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel"><strong>ADD NEW MENU</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto">
                            <form action="" class="addFooter" id="add-menu-form" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="sel1"><strong>Select Menu:</strong></label>
                                    <select class="form-control" name="menu_id" id="menu_id" readonly>
                                        <option value="Menu">Menu</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="sel1"><strong>Sub Menu Name:</strong></label>
                                    <input type="text" name="sub_menu" id ="sub_menu"class="form-control form-control" placeholder="Enter Sub Menu Name" required>
                                </div>
                                <div class="form-group">
                                    <label for="sel1"><strong>Sub Menu Details:</strong></label>
                                    <textarea name="sub_menu_details" class="summernote form-control form-control" id="sub_menu_details" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="sel1"><strong>Select Status:</strong></label>
                                    <select class="form-control" name="sub_status" id="sel2" required>
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
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
    {{--Add Menu Modal ends--}}

    {{--Edit Menu Modal starts--}}
    <div class="modal ml-5 fade bd-example-modal-lg" tabindex="-1" id="edit-submenu" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel"><strong>EDIT SUB MENU</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto">
                            <form action="" class="addFooter" id="edit-menu-form" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="sel1"><strong>Select Menu:</strong></label>
                                    <select class="form-control" name="menu_id" id="edit_menu_id" readonly>
                                        <option value="Menu">Menu</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="sel1"><strong>Sub Menu Name:</strong></label>
                                    <input type="text" placeholder="Enter Sub Menu Name" name="sub_menu" id ="edit_sub_menu" class="form-control form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="sel1"><strong>Sub Menu Details:</strong></label>
                                    <textarea name="sub_menu_details" class=" summernote form-control form-control" id="edit_sub_menu_details" required></textarea>
                                </div>
                                <input type="text" name="id" id="id" hidden>
                                <div class="form-group">
                                    <label for="edit_sel2"><strong>Select Status:</strong></label>
                                    <select class="form-control" name="sub_status" id="edit_sel2" required>
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary theme-bg gradient">Update</button>
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
    {{--Edit Menu Modal ends--}}




    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable();
        } );


        $(document).ready(function(){
            $( "#add-menu-form" ).submit(function( event ) {

                event.preventDefault();
                let formData = new FormData()
                let menu_id = $(this).find("select[name=menu_id]").val();
                let sub_menu = $(this).find("input[name=sub_menu]").val();
                let sub_menu_details = $(this).find("textarea[name=sub_menu_details]").val();
                let sub_status = $(this).find("select[name=sub_status]").val();
                // console.log(footer)


                formData.append('menu_id', menu_id);
                formData.append('sub_menu', sub_menu);

                formData.append('sub_menu_details', sub_menu_details);
                formData.append('sub_status', sub_status);


                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    processData: false,
                    contentType: false,
                });
                $.ajax({

                    type: "POST",
                    url: "/admin/setting/save-sub-menu",
                    data: formData,
                    success: function(response){
                        $('#menu_id').val('');
                        $('#sub_menu').val('');
                        $('#sub_menu_details').val('');
                        $('#sub_status').val('');
                        toastr.options = {
                            "timeOut": "2000",
                            "closeButton": true,

                        };
                        $('.closeBtn').click();
                        toastr['success']('Successfully Stored');
                        $('tbody').append(`
                        <tr data-id="${response.data.id}">
                                <td>${response.data.sub_menu}</td>
                                <td>${response.data.sub_status}</td>
                                <td>
                                <button type="button" data-toggle="modal" data-target="#edit-submenu" data-id="${response.data.id}" style="cursor: pointer" class="btn btn-primary btn-round mr-1 editBtn">
                                  
                                    <i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    <button data-id="${response.data.id}" class="btn btn-danger btn-round Btn_delete" style="cursor: pointer" type="submit"><i class="fa fa-trash"></i></button>
                                </td>

                            </tr>
                        `)
                    },
                    error: function(error){
                        console.log(error)
                        alert("can not change");
                    }
                });
            });
        });




        // $(document).ready(function(){
        //     $( ".addFooter" ).submit(function( event ) {

        //         event.preventDefault();
        //         let formData = new FormData()
        //         let id = $(this).find("input[name=id]").val();
        //         // console.log(footer)

        //         let privecy_policy = $(this).find("textarea[name=privecy_policy]").val();
        //         formData.append('id', id);
        //         formData.append('privecy_policy', privecy_policy);
        //         $.ajaxSetup({
        //             headers: {
        //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //             },
        //             processData: false,
        //             contentType: false,
        //         });
        //         $.ajax({

        //             type: "POST",
        //             url: "/admin/setting/PrivecyPolicy",
        //             data: formData,
        //             success: function(response){
        //                 console.log(response)
        //                 swal("Success", "Update successfully","success")
        //             },
        //             error: function(error){
        //                 console.log(error)
        //                 alert("can not change");
        //             }
        //         });
        //     });
        // });

        //Edit
        $(function () {
            $(document).on('click','.editBtn',function (e) {
                e.preventDefault();
                let id = $(this).attr('data-id');

                $.ajax({
                    type: 'GET',
                    url: `/admin/setting/sub-edit/${id}`,
                    success: (data) => {
                        $('#edit_sub_menu').val(data.sub_menu);
                        $('#edit_sub_menu_details').summernote('code', data.sub_menu_details);
                        $('#id').val(data.id);
                        let options = $('#edit_sel2 option');
                        $.each(options,function (index,value){
                            if(value.text == data.sub_menu_status){
                                $(value).attr('selected',true);
                            }
                        });
                    },
                    error: (error) => {
                        console.log(error);
                    }
                })
            });

            $(document).on('submit','#edit-menu-form',function (e){
                e.preventDefault();
                let formData = new FormData()
                let menu_id = $('#edit_menu_id').val();
                let sub_menu = $('#edit_sub_menu').val();
                let sub_menu_details = $('#edit_sub_menu_details').val();
                let sub_status = $('#edit_sel2').val();
                let id = $('#id').val();
                // console.log(footer)


                formData.append('menu_id', menu_id);
                formData.append('sub_menu', sub_menu);

                formData.append('sub_menu_details', sub_menu_details);
                formData.append('sub_status', sub_status);


                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    processData: false,
                    contentType: false,
                });

                $.ajax({
                    type: 'POST',
                    url: `/admin/setting/update-sub-menu/${id}`,
                    data: formData,
                    success: (data) => {
                        const {sub_menu,id} = data.data
                        let tr = $(`tr[data-id=${data.data.id}]`);
                        let td = $(tr).find('td');
                        $(td[0]).text(sub_menu);
                        $(td[1]).text(sub_status);
                        $('.closeBtn').click();
                    }
                })
            })
        })




        //delete

        $(document).ready(function () {
            $(document).on('click', '.Btn_delete', function (e) {
                e.preventDefault();
                let id = $(this).attr('data-id');
                let tableRow = $(this).parent().parent();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success ml-2',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'DELETE',
                            url: `/admin/setting/${id}/sub-menu`,
                            success: (data) => {
                                $(tableRow).remove();
                                swalWithBootstrapButtons.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                )

                            },

                        })


                    }
                    else if (
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire(
                            'Cancelled',
                            'Your file is safe :)',
                            'error'
                        )
                    }

                })

            });

        });
    </script>
@endsection

@section('page-stylesheet')

@endsection

@section('page-scripts')

    <!--<script src="{{asset('/backend/assets/bundles/mainscripts.bundle.js')}}"></script>-->
    <script src="{{asset('/backend/assets/vendor/summernote/dist/summernote-bs4.min.js')}}"></script>
    <script>
        $('.summernote').summernote({
            placeholder: 'Add sub menu details',
            tabsize: 1,
            height: 220
        });
    </script>
@endsection
