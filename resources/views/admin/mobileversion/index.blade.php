@extends('admin.layout.master.master')

@section('main-content')


<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            
            <div class="body">
                <form action="" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">App Version</label>

                        <input type="text" name="version" class="form-control" value="{{$version->app_version}}">
                    </div>

                    <button class="btn btn-primary">
                        Save
                    </button>
                </form>
            </div>
        </div>
    </div>

</div>



@endsection
