@extends('admin.layout.master.master')

@section('main-content')
<div class="col-lg-12">
    <div class="card">
        <div class="header">
            <h2 class="text-secondary"><strong>Subsribers</strong></h2>
            <ul class="header-dropdown dropdown">
                
                <li><a href="javascript:void(0);" class="full-screen"><i class="fa fa-expand"></i></a></li>
               
            </ul>
        </div>
        <div class="body">
            <div class="table-responsive">
                <table class="table table-striped table-hover dataTable js-exportable">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Phone</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Phone</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @forelse ($subsribers as $subsriber)
                        <tr>
                            <td>{{ $subsriber->id }}</td>
                            <td>{{ $subsriber->phone }}</td>

                        </tr>
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
@endsection