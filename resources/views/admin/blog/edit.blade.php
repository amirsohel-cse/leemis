@extends('admin.layout.master.master')

@section('main-content')


@if(Session::get('success'))
<div class="alert text-white container" style="background: #57d81b;">
    {{ Session::get('success') }}
</div>
@endif


<div class="col-lg-10 offset-md-1">
   
    <div class="card">
        <div class="d-flex justify-content-end">
            <a href="{{route('blogs')}}" class="btn btn-primary theme-bg gradient mr-2 mt-2"> Blog List</a>
    
        </div>
        <div class="header">
            <h2><strong>EDIT BLOG</strong></h2>
        </div>
      
        <div class="body">
            <form action="{{ route('blogupdate',$blog->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">

                </div>
                <div class="form-group">
                    <h6> <strong>Title* </strong></h6>
                    <div class="input-group">
                        <input type="text" name="title" placeholder="Enter Title" class="form-control" value="{{$blog->title}}" aria-describedby="basic-addon1">
                    </div>
                    @error('title')
                    <div class="text-danger">{{ $message }}</div>
                       @enderror
                </div>

                <div class="form-group">
                    <h6><strong>Current Feature Photo*</strong></h6>
<img src="{{asset('uploads/blogs/'.$blog->image)}}" alt="" width="150px">

<h6> <strong>Change Feature Photo*</strong></h6>
                    <div class="input-group">
                        <input type="hidden" value="{{$blog->image  }}" name="image" class="form-control" >
                        <input type="file" name="image" class="form-control" >
                    </div>
                    @error('image')
                    <div class="text-danger">{{ $message }}</div>
                       @enderror
                </div>
                <div class="form-group">
                    <h6><strong>Details*</strong></h6>
                    <div class="input-group">
                        <textarea name="body" class="summernote">{!!$blog->details!!}</textarea>
                    </div>
                    @error('body')
                    <div class="text-danger">{{ $message }}</div>
                       @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary theme-bg gradient">Edit Blog</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('page-scripts')
    <script>
        $('.summernote').summernote({
            placeholder: 'Type your message',
            tabsize: 1,
            height: 300,
            lang: 'bd-BD'
        });
    </script>
    <script>
        $(".alert:not(.not_hide)").delay(5000).slideUp(500, function () {
         $(this).alert('close');
     });
    </script>
@endsection

