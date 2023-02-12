@extends('admin.layout.master.master')

@section('main-content')

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-header">
                    <button type="button" class="btn btn-primary mr-3 mt-2 adModal"><i class="la la-plus"></i>@lang('Create Category')</button>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive--md  table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th scope="col">@lang('Name')</th>
                                    <th scope="col">@lang('Status')</th>

                                    <th scope="col">@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($helps as $help)
                                    <tr>
                                        <td>{{$help->name}}</td>
                                        <td>
                                            @if($help->status)
                                             <span class="badge badge-success">Active</span>
                                            @else
                                            <span class="badge badge-danger">InActive</span>
                                            @endif
                                             
                                        </td>

                                        <td>
                                            <button class="btn btn-primary edit" data-help="{{$help}}" data-url="{{route('help-center.update', $help->id)}}">Edit</button>

                                            <a href="{{route('articles.index', $help->id)}}" class="btn btn-primary">Articles</a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" tabindex="-1" role="dialog" id="add">
        <div class="modal-dialog" role="document">
            <form action="{{route('help-center.store')}}" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="from-group">
                            <label for="">Category Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        
                        <div class="from-group">
                            <label for="">Category Status</label>
                            <select name="status" id="" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Create</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="edit">
        <div class="modal-dialog" role="document">
            <form action="" method="post">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="from-group">
                            <label for="">Category Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        
                        <div class="from-group">
                            <label for="">Category Status</label>
                            <select name="status" id="" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


@push('scripts')
    <script>

        

        $(function(){
            $('.adModal').on('click', function(){
                const modal = $('#add')

                modal.modal('show')
            })

            $('.edit').on('click', function(){
                const modal = $('#edit')
                modal.find('input[name=name]').val($(this).data('help').name)
                modal.find('select[name=status]').val($(this).data('help').status)

                modal.find('form').attr('action', $(this).data('url'))

                modal.modal('show')
            })
        })

    </script>
@endpush
