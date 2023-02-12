@extends('admin.layout.master.master')

@section('main-content')

    <div class="row">

        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Transalate Into Bangla</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <form action="" method="POST">
                            @csrf

                            <table class="table table-bordered">
                                @foreach ($language as $key => $nav)

                                    <tr>
                                        <td class="w-50">{{ $key }}</td>
                                        <td class="w-50">
                                            <input type="text" value="{{ $nav }}" class="form-control" name="lang[{{$key}}]">
                                        </td>
                                    </tr>
                                @endforeach

                            </table>
                            
                                
                                <button type="submit" class="btn btn-primary">Update Language</button>
                            
                           
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>





@endsection
