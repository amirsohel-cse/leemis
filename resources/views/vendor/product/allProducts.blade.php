@extends('vendor.layout.master.master')


@section('main-content')

    <div class="row my-4">
        <div class="col-md-12">
            <h3><b>Products</b></h3>
        </div>
        <div class="col-md-12">
            <h6><a href="">Dashboard ></a> <a href="">Products ></a> <a href="">All Products > </a> <a href="">Add
                    Product</a></h6>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-12">
            <div class="card">
                <div class="body">
                    <div class="row my-3">
                        <div class="col-md-5"></div>
                        <div class="col-md-3">

                        </div>
                        <div class="col-md-4 d-flex flex-row-reverse">
                            <a href="{{ route('vendor.addproduct') }}" class="btn btn-primary theme-bg gradient btn-round"><i
                                    class="fa fa-plus"></i><b>
                                    Add New Product</b></a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Stock</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Options</th>
                                  
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($products as $row)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{ $row->name }}<br> <small>Id: {{ $row->id }}</small> <small>SKU:
                                                {{ $row->sku }}</small> <small>Vendor: </small></td>
                                        <td>Physical</td>
                                        <td>{{ $row->stock }}</td>
                                        <td>{{ $row->price }}BDT</td>
                                        <td>
                                            <select class="theme-bg"  data-id="{{$row->id}}" id="selectStatus">
                                                <option class="text-dark" value="1" {{$row->status == 1 ? 'selected' : ''}}>Active</option>
                                                <option value="0" {{$row->status == 0 ? 'selected' : ''}}>Deactive</option>
                                            </select>
                                        </td>
                                        <td>
                                            {{-- <button data-id="{{$row->id}}" data-toggle="modal" data-target="#editProductModal" class="btn btn-primary btn-round mr-1 editBtn" style="cursor: pointer" type="button"><i class="fa fa-edit"></i> Edit</button> --}}
                                            <a  href="{{ route('vendor.productEdit', $row->id) }}"
                                                class="btn btn-primary btn-round deleteBtn" style="cursor: pointer"
                                                type="submit"><i class="fa fa-edit"></i> Edit</a>
                                         

                                            <a href="{{ route('vendor.productView', $row->id) }}"
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


    @section('page-stylesheet')
        <!--<link rel="stylesheet" href="{{ asset('/backend/assets/css/nice-select.css') }}">-->

    @endsection
    @section('page-scripts')
        <!--<script src="{{ asset('/backend/assets/js/jquery.nice-select.js') }}"></script>-->
        <script !src="">
            // $(document).ready(function() {
            //     $('select').niceSelect();
            // });
        </script>
        <script src="{{ asset('/backend/js/product.js') }}"></script>
        
        
        <script>
                
                $(function(){
                    $('#selectStatus').on('change',function(){
                        if($(this).val() == 0 ){
                            localStorage.removeItem("items");
                        }
                    })    
                })
            
        </script>

    @endsection
