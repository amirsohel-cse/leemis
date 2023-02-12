@extends('vendor.layout.master.master')


@section('main-content')

    <div class="block-header">
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12">
                <span>Review</span> <i class="fa fa-angle-right"></i>
                <span>Review List</span>
            </div>
        </div>
    </div>
    @if(Session::get('delete'))
        <div class="alert text-white container" style="background: #c41818;">
            {{ Session::get('delete') }}
        </div>
    @endif
    <div class="row clearfix">
        <div class="col-12">
            <div class="card">
                <div class="body">
                    <div class="row my-3">
                        <div class="col-md-5"></div>
                        <div class="col-md-3">

                        </div>
                        <div class="col-md-4 d-flex flex-row-reverse">

                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover dataTable js-exportable">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Reviewed By</th>
                                <th>Product Name</th>
                                <th>Rating(Star)</th>
                                <th>Comment</th>
                                {{--                                <th>Status</th>--}}
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            @forelse($ratings as $row)
                                <tr>
                                    <td>{{ $row->id}}</td>
                                    <td>{{ $row->name}}</td>
                                    <td>
                                        {{ Str::limit(@$row->product->name , 50) }}
                                    </td>
                                    <td>{{ $row->rating }}</td>
                                    <td>{{ $row->review }}</td>

                                    {{--                                    <td>--}}
                                    {{--                                        <select class="theme-bg"  data-id="{{$row->id}}" id="selectStatus">--}}
                                    {{--                                            <option class="text-dark" value="1" {{$row->status == 1 ? 'selected' : ''}}>Active</option>--}}
                                    {{--                                            <option value="0" {{$row->status == 0 ? 'selected' : ''}}>Deactive</option>--}}
                                    {{--                                        </select>--}}
                                    {{--                                    </td>--}}
                                    <td>
                                        <a href="{{ route('vendor.reviewView', $row->id) }}"
                                           class="btn btn-info btn-round" style="cursor: pointer"><i class="fa fa-eye"></i></a>
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


    <script src="{{ asset('/backend/js/product.js') }}"></script>

    <script>

        $(function(){
            $('#selectStatus').on('change',function(){
                if($(this).val() == 0 ){
                    localStorage.removeItem("items");
                }
            })
        })

    </script>

@endsection
