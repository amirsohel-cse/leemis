@extends('vendor.layout.master.master')
@section('main-content')
<div class="block-header">
  <div class="row clearfix">
      <div class="col-lg-8 col-md-12 col-sm-12">
          <h1>Product</h1>
          <span>Dashboard</span> <i class="fa fa-angle-right"></i>
          <span>Product</span> <i class="fa fa-angle-right"></i>
          <span>Product Details</span>
      </div>
  </div>
</div>
  
      <div class="card">
          <div class="body">
            <div class="row">


            <div style="width:30%" class="table-responsive-sm ml-5">
                        <table class="table border">
                            <tbody>
                                <tr>
                                <th class="45%" width="45%">Product Name</th>
                                <td width="10%">:</td>
                                <td class="45%" width="45%">{{ $product->name }}</td>
                            </tr>
                            
                            <tr>
                                <th class="45%" width="45%">Vendor Name</th>
                                <td width="10%">:</td>
                                <td class="45%" width="45%">{{ @$product->vendor->name }}</td>
                            </tr>
                            
                            <tr>
                                <th class="45%" width="45%">Product Sku</th>
                                <td width="10%">:</td>
                                <td class="45%" width="45%">{{ @$product->sku }}</td>
                            </tr>
                            
                             <tr>
                                <th class="45%" width="45%">Stock</th>
                                <td width="10%">:</td>
                                <td class="45%" width="45%">{{ @$product->stock }}</td>
                            </tr>
                            
                            
                            <tr>
                                <th width="45%">Category</th>
                                <td width="10%">:</td>
                                <td width="45%">{{ $product->categories->name }}</td>
                            </tr>
                            <tr>
                                <th width="45%">Sub Category</th>
                                <td width="10%">:</td>
                                <td width="45%">@if (isset($product->sub_categories->name)){{ $product->sub_categories->name }}@endif</td>
                            </tr>
                            <tr>
                                <th width="45%">Child Category</th>
                                <td width="10%">:</td>
                                <td width="45%">@if (isset($product->child_categories->name)){{ $product->child_categories->name }}@endif</td>
                            </tr>
                            <tr>
                                <th width="45%">Price</th>
                                <td width="10%">:</td>
                                <td width="45%">{{ $product->price }}</td>
                            </tr>

                            <tr>
                                <th width="45%">Brand Name</th>
                                <th width="10%">:</th>
                                <td width="45%">@if (isset($product->brand->name)){{ $product->brand->name }}@endif</td>
                            </tr>

                           <tr>
                                   <th width="45%">
                                       Varient
                                   </th>
                                   
                                   <th width="10%">:</th>
                                   
                                   <th width="45%">
                                       @foreach ($product->product_specification as $specification)
                                      
                                        @php 
                                            
                                            $attribute = \App\Model\CategoryAttribute::find($specification['category_attribute_id']);
                                            
                                            
                                            
                                        @endphp
                                                            
                                                <div class="col-md-4">
                                                    <span>{{$attribute->name}} : </span>
                                                    @foreach($attribute->options as $option)
                                                    
                                                        @if($specification['attribute'] == $option->id)
                                                        <span>{{$option->option}}</span>,
                                                        @endif
                                                    
                                                    @endforeach
                                                   
                                                </div>
                                                
                                                        
                                        @endforeach
                                   </th>

                            <tr>
                                <th width="45%">Offer Product</th>
                                <th width="10%">:</th>
                                <td width="45%">{{ $product->offer ?? 'N/A' }}</td>
                            </tr>

                            </tbody>
                        </table>
                    </div>

                    <div style="width:60%" class=" ml-5">
                        <table  style="table-layout:fixed; width:100%;" >
                            <tbody>
                                <tr class="border" >
                                    <th width="25%" class="p-2">Product Image</th>
                                    <td width="5%" class="p-2">:</td>
                                    <td class="p-2" ><img src="{{url($product->photo)}}" style="width:110px; height:80px;" ></td>
                                </tr>
                                <tr class="border p-2">
                                    <th class="p-2">Gallery Image</th>
                                    <td class="p-2">:</td>
                                    <td class="p-2"> @foreach($gallery as $data)<img  class="img-fluid" src="{{asset('uploads')}}/product-gallery/{{$data->image_file}}" id="fetureInputGallery" style="height: 80px;width: 100px;">
                                         @endforeach</td>
                                </tr>
                                <tr class="border">
                                    <th class="p-2">Description</th>
                                    <td class="p-2">:</td>
                                    <td class="p-2" >{!! $product->details !!}</td>
                                </tr>
                                <tr class="border">
                                    <th class="p-2">Tags</th>
                                    <td class="p-2">:</td>
                                    <td class="p-2">{{$product->tags}}</td>
                                </tr>
                                

                            </tbody>
                        </table>
                    </div>


             
         
          </div>
        </div>
          </div>
      </div>


  @endsection
