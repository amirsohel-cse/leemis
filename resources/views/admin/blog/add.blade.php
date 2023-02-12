@extends('admin.layout.master.master')

@section('main-content')

@if (session('success'))

  <div class="alert alert-success text-white" style="background: rgb(37, 184, 37)">
      {{session('success')}}
  </div>
  @endif



<div class="col-lg-10 offset-md-1">
    <div class="card">
        <div class="header">
            <h2><strong>Blog</strong></h2>
        </div>
        <div class="body">
            <form action="{{ route('addblog') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">

                </div>
                <div class="form-group">
                    <h6><strong> Title* </strong></h6>
                    <div class="input-group">
                        <input type="text" name="title" value="{{old('title')}}" class="@error('title') is-invalid @enderror form-control" placeholder="Enter title" aria-describedby="basic-addon1">
                    </div>
                    @error('title')
                    <div class="text-danger">{{ $message }}</div>
                       @enderror
                </div>

                <div class="form-group">
                    <h6><strong> Feature Photo* </strong></h6>
                    <div class="input-group">
                        <input type="file" name="image" class="@error('title') is-invalid @enderror form-control" >
                    </div>
                    @error('image')
                    <div class="text-danger">{{ $message }}</div>
                       @enderror
                </div>
                <div class="form-group">
                    <h6><strong>Details*</strong></h6>
                    <div class="input-group">
                        <textarea name="body"  value="{{old('body')}}"class="summernote"></textarea>
                    </div>
                    @error('body')
                    <div class="text-danger">{{ $message }}</div>
                       @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary theme-bg gradient">Add Blog</button>
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
            height: 300
        });
    </script>
@endsection

