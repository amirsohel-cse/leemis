@extends('admin.layout.master.master')
@section('main-content')
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12">
                <span>Review</span> <i class="fa fa-angle-right"></i>
                <span>Review Details</span>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="body">
            <div class="row">
                <div style="width:30%" class="table-responsive-sm ml-5">
                    <table class="table border" >
                        <tbody>
                        <tr>
                            <th class="45%" width="45%">Reviewed By</th>
                            <td width="10%">:</td>
                            <td class="45%" width="45%">{{ $rating->name }}</td>
                        </tr>
                        <tr>
                            <th class="45%" width="45%">Product Name</th>
                            <td width="10%">:</td>
                            <td class="45%" width="45%">{{ @$rating->product->name }}</td>
                        </tr>
                        <tr>
                            <th class="45%" width="45%">Rating (Star)</th>
                            <td width="10%">:</td>
                            <td class="45%" width="45%">{{ $rating->rating }}</td>
                        </tr>
                        <tr>
                            <th class="45%" width="45%">Comment</th>
                            <td width="10%">:</td>
                            <td class="45%" width="45%">{{ $rating->review }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    </div>



@endsection


@push('custom-style')

    <style>
        tr td{
            white-space: break-spaces !important
        }
    </style>

@endpush
