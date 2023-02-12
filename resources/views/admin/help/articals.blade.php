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
                    <button type="button" class="btn btn-primary mr-3 mt-2 adModal"><i class="la la-plus"></i>@lang('Create Article')</button>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive--md  table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th scope="col">@lang('title')</th>
                                    <th scope="col">@lang('Description')</th>
                                    <th scope="col">@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($id->articals as $artical)
                                    <tr>
                                        <td>{{$artical->title}}</td>
                                        <td>
                                            {{$artical->description}}
                                        </td>

                                        <td>
                                            <button class="btn btn-primary edit" data-article="{{$artical}}" data-url="{{route('articles.update', $id->id)}}">Edit</button>

                                            
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
            <form action="" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Create Article</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <input type="hidden" name="help_category_id" value="{{$id->id}}">

                        <div class="from-group">
                            <label for="">Article Title</label>
                            <input type="text" name="title" class="form-control">
                        </div>
                        
                        <div class="from-group">
                            <label for="">Article Description</label>
                           <textarea name="description" id="" cols="30" rows="10" class="form-control"></textarea>
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
                        <h5 class="modal-title">Update Article</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <input type="hidden" name="article_id">


                        <div class="from-group">
                            <label for="">Article Title</label>
                            <input type="text" name="title" class="form-control">
                        </div>
                        
                        <div class="from-group">
                            <label for="">Article Description</label>
                           <textarea name="description" id="" cols="30" rows="10" class="form-control"></textarea>
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
                modal.find('input[name=title]').val($(this).data('article').title)
                modal.find('input[name=article_id]').val($(this).data('article').id)
                modal.find('textarea[name=description]').val($(this).data('article').description)

                modal.find('form').attr('action', $(this).data('url'))

                modal.modal('show')
            })
        })

    </script>
@endpush
