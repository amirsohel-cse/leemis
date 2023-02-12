@extends('admin.layout.master.master')


@section('main-content')
    <div class="block-header">
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12">
                <h1>Product</h1>
                <span>Dashboard</span> <i class="fa fa-angle-right"></i>
                <span>Product</span> <i class="fa fa-angle-right"></i>
                <span>Product View</span>
            </div>
        </div>
    </div>
    @if (Session::get('delete'))
        <div class="alert text-white container" style="background: #c41818;">
            {{ Session::get('delete') }}
        </div>
    @endif
    <div class="row clearfix">
        <div class="col-12">
            <div class="card">
                <div class="body">
                    <div class="row my-3">
                        <div class="col-md-5"></div>
                        <div class="col-md-3">

                        </div>
                        <div class="col-md-4 d-flex flex-row-reverse">

                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Product Name</th>
                                    <th>Product Code</th>
                                    <th>Vendor Name</th>
                                    <th>Stock</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Is Featured</th>
                                    <th>Options</th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse($products as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ Str::limit($row->name, 50) }}<br></small> <small>SKU:
                                                {{ $row->sku }}</small> <small>Shop:
                                                {{ isset($row->vendor->shop_name) ? $row->vendor->shop_name : '' }} </small>
                                        </td>
                                        <td>{{ $row->code }}</td>
                                        <td>{{ $row->vendor->name }}</td>
                                        <td>{{ $row->stock }}</td>
                                        <td>{{ $row->price }}</td>

                                        <td>
                                            <select class="theme-bg" data-id="{{ $row->id }}" id="selectStatus">
                                                <option class="text-dark" value="1"
                                                    {{ $row->status == 1 ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ $row->status == 0 ? 'selected' : '' }}>Deactive
                                                </option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="theme-bg" data-id="{{ $row->id }}" id="selectIsFeatured">
                                                <option class="text-dark" value="1"
                                                    {{ $row->featured == 1 ? 'selected' : '' }}>Yes</option>
                                                <option value="0" {{ $row->featured == 0 ? 'selected' : '' }}>No
                                                </option>
                                            </select>
                                        </td>
                                        <td>
                                            <a href="{{ route('productEdit', $row->id) }}"
                                                class="btn btn-primary btn-round deleteBtn" style="cursor: pointer"
                                                type="submit"><i class="fa fa-edit"></i> Edit</a>


                                            <a href="{{ route('productView', $row->id) }}"
                                                class="btn btn-info btn-round deleteBtn" style="cursor: pointer"
                                                type="submit"><i class="fa fa-eye"></i></a>
                                        </td>
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


    </div>
@endsection


@section('page-scripts')
    <script src="{{ asset('/backend/js/product.js') }}"></script>

    <script>
        $(function() {
            $('#selectStatus').on('change', function() {
                if ($(this).val() == 0) {
                    localStorage.removeItem("items");
                }
            })
        })
    </script>
@endsection
