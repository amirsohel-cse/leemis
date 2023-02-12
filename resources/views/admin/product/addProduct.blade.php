@extends('admin.layout.master.master')
@section('main-content')
    <div class="div1">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-lg-8 col-md-12 col-sm-12">
                    <h1><strong>Add Product</strong></h1>
                    <span>Dashboard</span> <i class="fa fa-angle-right"></i>
                    <span>Product</span> <i class="fa fa-angle-right"></i>
                    <span>Add Product</span>
                </div>
            </div>
        </div>
        @if(Session::get('success'))
        <div class="alert text-white container" style="background: #3daa1b;">
            {{ Session::get('success') }}
        </div>
        @endif
        <form method="post" action="createProduct" enctype="multipart/form-data">
            @csrf
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12">
                    <div class="card">

                        <div class="body">
                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <label for="basic-url"><span style="font-size: 18px;"><strong>Product Name</strong></span>
                                    </label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                        </div>
                                        <input type="text" class="form-control" placeholder="Enter Product Name"
                                            aria-label="Username" aria-describedby="basic-addon1" name="name" value="{{old('name')}}">
                                    </div>
                                  @error('name')
                                        <p class="form-text text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <label for="basic-url"> <span style="font-size: 18px;"><b>Product Sku</b></span></label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                        </div>
                                        <input type="text" class="form-control" placeholder="dRE6871FNk"
                                            aria-label="Product" aria-describedby="basic-addon1" name="sku" value="{{old('sku')}}">
                                        
                                    </div>
                                     @error('sku')
                                        <p class="form-text text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <label for="basic-url"><span style="font-size: 18px;"><b>Category</b></span></label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                        </div>
                                        <select class="form-control" name="category_id" id="categoryId">
                                            <option value="" data-display="Select">Select Category</option>
                                            @forelse($categories as $row)
                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                            @empty
                                            <option value="">No Categories Added</option>
                                            @endforelse
                                        </select>
                                    </div>
                                     @error('category_id')
                                        <p class="form-text text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <label for="basic-url"><span style="font-size: 18px;"><b>Sub Category</b></span></label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                        </div>
                                        <select class="form-control" name="subcategory_id" id="subcategoryId">
                                            <option value="" data-display="Select">Select Subcategory</option>
                                            @forelse($subcategories as $row)
                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                            @empty
                                            <option value="">No Subcategories Added</option>
                                            @endforelse
                                        </select>
                                    </div>
                                      @error('subcategory_id')
                                        <p class="form-text text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <label for="basic-url"><span style="font-size: 18px;"><b> Child
                                                Category</b></span></label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                        </div>
                                        <select class="form-control" name="childcategory_id" id="childcategoryId">
                                            <option value="" data-display="Select">Select category</option>
                                            @forelse($childcategories as $row)
                                            <option value="{{$row->id}}">{{$row->name}}</option>
                                            @empty
                                            <option value="">No Childcategories Added</option>
                                            @endforelse
                                        </select>

                                    </div>
                                     @error('childcategory_id')
                                        <p class="form-text text-danger">{{ $message }}</p>
                                    @enderror

                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-default">Feature Image </span>
                                        </div>
                                        <input type="file" name="photo" class="dropify photo" value="{{old('photo')}}" required>
                                    </div>
                                     @error('photo')
                                        <p class="form-text text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                <label for="basic-url"><span style="font-size: 18px;"><b>Brand</b></span></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                    </div>
                                    <select class="form-control" name="brand_id" id="brandcategoryId">
                                        <option value="" data-display="Select">Select Brand</option>
                                        @forelse($brand as $row)
                                        <option value="{{$row->id}}">{{$row->name}}</option>
                                        @empty
                                        <option value="">No Brand Added</option>
                                        @endforelse
                                    </select>

                                </div>
                                @error('brand_id')
                                    <p class="form-text text-danger">{{ $message }}</p>
                                @enderror

                            </div>
                            <div class="col-lg-6 col-md-12">
                                <label for="basic-url"><span style="font-size: 18px;"><b>Want to Feature</b></span></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                    </div>
                                    <select class="form-control" name="feature">
                                        <option disabled>Select</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>

                            </div>
                            <label for="basic-url"> <span style="font-size: 18px;"><b>Product Gallery
                                        Images</b></span></label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                </div>
                                 <input id='files' class="custom-file-input" name="image_file[]" type='file'  id="galleryInput" multiple/>
                                    <label class="custom-file-label" for="inputGroupFile01" >Choose file</label>
                                     <output id='result' />
                                    </form>
                            </div>
                                 @error('image_file')
                                        <p class="form-text text-danger">{{ $message }}</p>
                                    @enderror

                            <div class="row my-5">

                                <div class="fancy-checkbox mx-5">
                                    <label><input type="checkbox" id="checked" onclick="valueChanged()"><span
                                            style="font-size: 18px;"><strong>Allow Estimated Shipping Time</strong></span></label>
                                </div>

                                <div class="my-3 col-md-12" id="field" style="display:none">

                                    <label for="basic-url"><span style="font-size: 18px;"><strong>Product Estimated Shipping
                                                Time</strong></span></label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                        </div>
                                        <input type="text" class="form-control" placeholder="Estimated Shipping Time"
                                            aria-label="Product Name" aria-describedby="basic-addon1" name="ship" value="{{old('ship')}}">
                                    </div>
                                </div>
                                <div class="fancy-checkbox mx-5">
                                    <label><input type="checkbox" id="checked1" onclick="valueChanged1()"><span
                                            style="font-size: 18px;"><strong>Allow Product Sizes</strong></span></label>
                                </div>
                                <div class="my-3 col-md-12" id="field1" style="display:none">
                                    <div class="row" id="size">
                                        <div class="col-md-4">
                                            <label for="basic-url"><span style="font-size: 15px;"><strong>Size Name :</strong> (eg.
                                                    S,M,L,XL,XXL,3XL,4XL)
                                                </span></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                </div>
                                                <input type="text" class="form-control" placeholder="Size Name"
                                                    aria-label="Product Name" aria-describedby="basic-addon1" name="size[]" value={{old('checked1')}}>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="basic-url"><span style="font-size: 15px;"><strong>Size Qty :</strong> (Number
                                                    of
                                                    quantity of this size)
                                                </span></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                </div>
                                                <input type="text" class="form-control" placeholder="1"
                                                    aria-label="Product Name" aria-describedby="basic-addon1"
                                                    name="size_qty[]">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="basic-url"><span style="font-size: 15px;"><strong>Size Price :</strong> (This
                                                    price
                                                    will be added with base price)
                                                </span></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                </div>
                                                <input type="number" min="0" value="0" step="0.01" class="form-control"
                                                    placeholder="0" aria-label="Product Name"
                                                    aria-describedby="basic-addon1" name="size_price[]" value={{old('size_price')}}>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row my-4">
                                        <div class="col-md-5"></div>
                                        <div class="col-md-4">

                                            <a id="addSize" class="btn btn-outline-primary"><i class="fa fa-plus"><strong> Add
                                                More Size </strong></i></a>

                                        </div>
                                        <div class="col-md-3"></div>
                                    </div>
                                </div>


                                <div class="fancy-checkbox ml-5">
                                    <label><input type="checkbox" id="checked2" onclick="valueChanged2()"><span
                                            style="font-size: 18px;"><strong>Allow Product Colors</strong></span></label>
                                </div>
                                <div class="my-3 col-md-12" id="field2" style="display:none">
                                    <label for="basic-url"><span style="font-size: 18px;"><strong>Add Product Color</strong></span>
                                        (Choose
                                        Your Favorite Colors)</label>
                                    <div class="input-group" >
                                        <div class="input-group-prepend">
                                        </div>
                                        <div class="col-md-12" id="color">



                                        <input type="text" class="form-control" placeholder="Enter Product Color"
                                            aria-label="Product Name" aria-describedby="basic-addon1" name="color[]" value="{{old('color')}}">
                                    </div>
                                </div>

                                    <div class="row my-5">
                                        <div class="col-md-5"></div>
                                        <div class="col-md-4">

                                                    <a id="addColor" class="btn btn-outline-primary"><i class="fa fa-plus"> <strong>Add
                                                        More Color</strong></i></a>

                                                </div>
                                        <div class="col-md-3"></div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <label for="basic-url"><span style="font-size: 18px;"><strong>Product Current
                                                Price</strong></span> (In
                                        BDT)</label>
                                    <div class="input-group ">
                                        <div class="input-group-prepend">
                                        </div>
                                        <input type="number" min="0" step="0.01" class="form-control"
                                            placeholder="e.g 20" aria-label="Product Name" aria-describedby="basic-addon1"
                                            name="price" value="{{old('price')}}">
                                    </div>
                                     @error('price')
                                        <p class="form-text text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <label for="basic-url"><span style="font-size: 18px;"><strong>Product Offer Price</strong></span>
                                        (Optional)</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                        </div>
                                        <input type="number" min="0" step="0.01" class="form-control"
                                            placeholder="e.g 20" aria-label="Product" aria-describedby="basic-addon1"
                                            name="previous_price" value="{{old('previous_price')}}">
                                    </div>
                                     @error('previous_price')
                                        <p class="form-text text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <label for="basic-url"><span style="font-size: 18px;"><strong>Cash Back</strong></span>
                                        (Optional)</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                        </div>
                                        <input type="number" min="0" value="0" step="0.01" class="form-control"
                                            placeholder="e.g 2000" aria-label="Product Name"
                                            aria-describedby="basic-addon1" name="cash_back" value="{{old('cash_back')}}">
                                    </div>


                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <label for="basic-url"><span style="font-size: 18px;"><strong>Offer Product</strong></span>
                                        (amount)</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                        </div>
                                        <select class="form-control" name="offerproduct">
                                            <option disabled>Select</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <label for="basic-url"><span style="font-size: 18px;"><strong>Product Tax</strong></span>
                                        (amount)</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                        </div>
                                        <input type="number" min="0" value="0" step="0.01" class="form-control"
                                            placeholder="Enter Tax" aria-label="Product Name"
                                            aria-describedby="basic-addon1" name="tax" value="{{old('tax')}}">
                                    </div>
                                      @error('tax')
                                        <p class="form-text text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <label for="basic-url"><span style="font-size: 18px;"><strong>Product Stock</strong></span> (Leave
                                        Empty
                                        will Show Always Available)</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                        </div>
                                        <input type="number" class="form-control" placeholder="e.g 20"
                                            aria-label="Product Name" aria-describedby="basic-addon1" name="stock" value="{{old('stock')}}">
                                    </div>
                                </div>


                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <label for="basic-url"><span style="font-size: 18px;"><strong>Product
                                                Description</strong></span></label>
                                     <div class="form-floating">
                                        <textarea class="form-control" placeholder="Enter Description"
                                            id="summernote" name="details" s></textarea>
                                    </div>
                                     @error('details')
                                        <p class="form-text text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-md-12 ">
                                    <label for="basic-url"><span style="font-size: 18px;"><strong>Vat Exluded</strong></span></label>
                                    <div class="fancy-checkbox mt-3">
                                        <label><input type="checkbox" checked name="vat" value="vat excluded"><span><strong>Check if vat is excluded</strong></span></label>
                                    </div>
                                    <hr>
                                    <label for="basic-url"><span style="font-size: 18px;"><strong>Online Payment Only</strong></span></label>
                                    <div class="fancy-checkbox mt-3">
                                        <label><input type="checkbox" name="online_payment" value="1"><span><strong>Check if only online payment is applicable</strong></span></label>
                                    </div>
                                </div>

                            </div>
                            <div class="row mt-3">
                                <div class="col-lg-6 col-md-12">
                                    <label for="basic-url"><span style="font-size: 18px;"><strong>Youtube Video URL</strong></span>
                                        (Optional)</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                        </div>
                                        <input type="text" class="form-control" placeholder="Enter Youtube Video URL"
                                            aria-label="Product Name" aria-describedby="basic-addon1" name="youtube" value="{{old('youtube')}}">
                                    </div>

                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <label for="basic-url"><span style="font-size: 18px;"><strong>Tags</strong></span> (Seperate with
                                        comma)</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                        </div>
                                        <input type="text" class="form-control" aria-label="Product Name" placeholder="e.g aaa,bbb"
                                            aria-describedby="basic-addon1" name="tags" value="{{old('tags')}}">
                                    </div>
                                     @error('tags')
                                        <p class="form-text text-danger">{{ $message }}</p>
                                    @enderror

                                </div>


                            </div>

                            <div class="row">
                                <div class="col-md-4"></div>
                                <div class=" col-md-4 mt-4">

                                    <button type="submit" class="btn btn-primary theme-bg gradient btn-round p-3 px-5"
                                        style="font-size: 22px;"><strong>Create Product</strong></button>
                                </div>
                                <div class="col-md-4"></div>
                            </div>





                        </div>
                    </div>
                </div>

            </div>
        </form>

        <script>
            function valueChanged() {
                var checkBox = document.getElementById("checked");
                var text = document.getElementById("field");
                if (checkBox.checked == true) {
                    text.style.display = "block";
                } else {
                    text.style.display = "none";
                }
            }
        </script>
        <script>
            function valueChanged1() {
                var checkBox = document.getElementById("checked1");
                var text = document.getElementById("field1");
                if (checkBox.checked == true) {
                    text.style.display = "block";
                } else {
                    text.style.display = "none";
                }
            }
        </script>
        <script>
            function valueChanged2() {
                var checkBox = document.getElementById("checked2");
                var text = document.getElementById("field2");
                if (checkBox.checked == true) {
                    text.style.display = "block";
                } else {
                    text.style.display = "none";
                }
            }
        </script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script>
            $(document).ready(function() {
                $("#addColor").on('click',function(e) {

                    $("#color").append(`

                    <input type="text" class="form-control mt-3" placeholder="Enter Product Color"
                                            aria-label="Product Name" aria-describedby="basic-addon1" name="color[]">

                    `);

                });



                $("#addSize").on('click',function(e) {

                    $("#size").append(`

                    <div class="row" id="size">
                                        <div class="col-md-4">
                                            <label for="basic-url"><span style="font-size: 15px;"><b>Size Name :</b> (eg.
                                                    S,M,L,XL,XXL,3XL,4XL)
                                                </span></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    {{-- <span class="input-group-text">Shirt</span> --}}
                                                </div>
                                                <input type="text" class="form-control" placeholder="Size Name"
                                                    aria-label="Product Name" aria-describedby="basic-addon1" name="size[]">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="basic-url"><span style="font-size: 15px;"><b>Size Qty :</b> (Number
                                                    of
                                                    quantity of this size)
                                                </span></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    {{-- <span class="input-group-text">Shirt</span> --}}
                                                </div>
                                                <input type="text" class="form-control" placeholder="1"
                                                    aria-label="Product Name" aria-describedby="basic-addon1"
                                                    name="size_qty[]">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="basic-url"><span style="font-size: 15px;"><b>Size Price :</b> (This
                                                    price
                                                    will be added with base price)
                                                </span></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    {{-- <span class="input-group-text">Shirt</span> --}}
                                                </div>
                                                <input type="number" min="0" value="0" step="0.01" class="form-control"
                                                    placeholder="0" aria-label="Product Name"
                                                    aria-describedby="basic-addon1" name="size_price[]">
                                            </div>
                                        </div>

                                    </div>

                    `);

                 });


            });
        </script>
        <script type="text/javascript">

         $(document).ready(function() {
              $('#summernote').summernote();});
        </script>

 <script>
           $(".alert:not(.not_hide)").delay(5000).slideUp(700, function () {
            $(this).alert('close');
        });
    </script>



    </div>
@endsection
