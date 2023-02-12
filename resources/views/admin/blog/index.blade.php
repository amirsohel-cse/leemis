@extends('admin.layout.master.master')

@section('main-content')



<div class="block-header">
    <div class="row clearfix">
        <div class="col-lg-8 col-md-12 col-sm-12">
            <h1><strong>Blogs</strong></h1>
            <span>Dashboard</span> <i class="fa fa-angle-right"></i>
            <span>Blogs</span> <i class="fa fa-angle-right"></i>

        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">

                <a href="{{route('blogadd')}}" class="btn btn-success btn-round"><i class="fa fa-plus"></i> Add Blog</a>

            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover dataTable js-exportable">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>

                            <th>Options</th>
                        </tr>
                        </thead>

                        <tbody>
                            @forelse ($blog as $b)

                            <tr>
                                <td>{{$b->id}}</td>
                                <td>{{$b->title}}</td>
                                <td>
                                    <a href="{{route('blogedit',$b->id)}}"  class="btn btn-primary btn-round mr-1 editBtn" style="cursor: pointer" type="button"><i class="fa fa-edit"></i> Edit</a>
                                    <a href="{{route('blogdelete',$b->id)}}"  class="btn btn-danger btn-round deleteBtn" style="cursor: pointer" type="submit"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>

                            @empty

                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>



@endsection
