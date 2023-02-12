@extends('admin.layout.master.master')
@section('main-content')
<div class="block-header">
  <div class="row clearfix">
      <div class="col-lg-8 col-md-12 col-sm-12">
          <h1>Vendor Withdraw</h1>
          <span>Dashboard</span> <i class="fa fa-angle-right"></i>
          <span>Vendor</span> <i class="fa fa-angle-right"></i>
          <span>Withdraw</span>
      </div>
  </div>
</div>
<div class="row clearfix">
    <div class="col-12">
        <div class="card">
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover dataTable js-exportable">
                        <thead>
                            <tr>
                                <th>Shop Name</th>
                                <th>Email</th>
                                <th>Amount</th>
                                <th>Method</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                          @forelse ($withdraw as $item)
                              
                          
                                <tr>
                                    <td>{{$item->vendor->shop_name}}</td>
                                    <td>{{$item->vendor->email}}</td>
                                    <td>{{$item->amount}}</td>
                                    <td>{{$item->method}}</td>
                                    <td>{{$item->created_at->format('d-M-Y')}}</td>

                                    <td>
                                      <select name="" class="theme-bg " data-id="{{$item->id}}" id="selectStatus" >
                                        <option class="text-dark" value="Pending" {{$item->status == "Pending" ? 'selected' : ''}}>Pending</option>
                                        <option class="text-dark" value="Processing" {{$item->status == "Processing" ? 'selected' : ''}}>Processing</option>
                                        <option class="text-dark" value="Completed" {{$item->status == "Completed" ? 'selected' : ''}}>Completed</option>
                                        <option class="text-dark" value="Declined" {{$item->status == "Declined" ? 'selected' : ''}}>Declined</option>
                                        
                                    </select>
                                    </td>
                                    <td>
                                        <a href="/admin/vendor/{{$item->id}}/withdrawview"
                                        class="btn btn-primary btn-round">Details <i class="fa fa-eye"></i></a>
                                    </td>

                                </tr>
                                @empty
                              <p>No Request Found</p>
                                @endforelse
                        </tbody>
                    </table>
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

       //Status update ajax
       $(document).ready(function () {
        $(document).on('change','#selectStatus',function () {
        let status = $(this).val();
        let id = $(this).attr('data-id');
        $.ajax({
            type: 'GET',
            url: `/admin/vendor/${id}/withdrawrequest`,
            data: {status: status},
            success: (data) => {
                toastr.options = {
                    "timeOut": "2000",
                    "closeButton": true,
                };
                toastr['success'](data);
            },
            error: (error) => {
                console.log(error);
                }
            })
        });
        });
</script>


@endsection
