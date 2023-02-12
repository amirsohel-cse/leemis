@extends('vendor.layout.master.master')
@section('main-content')

<style>
    .container {
            display: block;
            position: relative;
            padding-left: 35px;
            margin-bottom: 12px;
            cursor: pointer;
            font-size: 22px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        /* Hide the browser's default checkbox */
        .container input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }
    /* Create a custom checkbox */
    .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 25px;
            width: 25px;
            background-color: #eee;
        }

        /* On mouse-over, add a grey background color */
        .container:hover input~.checkmark {
            background-color: #ccc;
        }

        /* When the checkbox is checked, add a blue background */
        .container input:checked~.checkmark {
            background-color: #6777ef;
        }

        /* Create the checkmark/indicator (hidden when not checked) */
        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        /* Show the checkmark when checked */
        .container input:checked~.checkmark:after {
            display: block;
        }

        /* Style the checkmark/indicator */
        .container .checkmark:after {
            left: 9px;
            top: 5px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 3px 3px 0;
            -webkit-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg);
        }

</style>
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
        <form method="post" action="{{route('vendorcreateProduct')}}" enctype="multipart/form-data">
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
                                        <input type="text" class="form-control" placeholder="eg : dRE6871FNk"
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
                                        <select class="form-control categoryId" name="category_id" id="categoryId">
                                            <option value="" data-display="Select">Select Category</option>
                                            @forelse($categories as $row)
                                            <option value="{{$row->id}}" {{old('category_id') == $row->id ? 'selected' : ''}}>{{$row->name}}</option>
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
                                            <option value="{{$row->id}}" {{old('childcategory_id') == $row->id ? 'selected' : ''}}>{{$row->name}}</option>
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
                               
                            </div>

                            <div class="col-md-12">
                                <div class=" row appearAttributes">
                                    
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-default">Feature Image (Image size should be 1000x1000 pixel)</span>
                                        </div>
                                        <input type="file" name="photo" class="dropify photo" value="{{old('photo')}}" required>
                                    </div>
                                     @error('photo')
                                        <p class="form-text text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <label for="basic-url"> <span style="font-size: 18px;"><b>Product Gallery
                                        Images</b></span> (Image size should be 1000x1000 pixel)</label>
                                        <!--<div class="mb-3">-->
                                        <!--  <label for="formFileMultiple" class="form-label">Multiple files input example</label>-->
                                        <!--  <input class="form-control" type="file" id="formFileMultiple" multiple>-->
                                        <!--</div>-->
                                        
                                    <!--<input id='files' class="custom-file-input" name="image_file[]" type='file' id="galleryInput" multiple/>-->
                                    <!--<input class="form-control" name="image_file[]" type='file' id="galleryInput" multiple/>-->
                                    <!--<label class="custom-file-label" for="inputGroupFile01" >Choose file</label>-->
                                     <!--<output id='result' />-->
                                    <!--</form>-->
                                    <div id="form-upload">
                                        <div class="form-group">
                                            <input type="file" class="form-control" name="image_file[]" multiple id="upload-img" />
                                        </div>
                                        <div class="img-thumbs img-thumbs-hidden" id="img-preview"></div>
                                    </div>
                                 @error('image_file')
                                        <p class="form-text text-danger">{{ $message }}</p>
                                    @enderror
                           

                            </div>


                            </div>
                            
                            <div class="row ">
                                <div class="col-md-12">
                                    <button class="btn btn-primary spec" type="button"> <i class="fa fa-plus"></i> Add New Specification</button>
                                </div>    
                                
                                
                                 <div class="col-md-4">
                                    <label>Specification Title</label>
                                    <input name="specification[0][title]" class="form-control" required>
                                </div>
                                
                                <div class="col-md-8">
                                    <label>Specification Details</label>
                                    <input name="specification[0][details]" class="form-control" required>
                                </div>
                                
                              
                                
                                
                                <div class="col-md-12 appear">
                                    
                                </div>
                                
                                
                                @error('specification.*.title')
                                        <p class="form-text text-danger">{{ $message }}</p>
                                @enderror
                                
                                 @error('specification.*.details')
                                        <p class="form-text text-danger">{{ $message }}</p>
                                @enderror
                                
                               
                                
                            </div>

                            <div class="row my-5">
                                <div class="my-3 col-md-12" id="field">

                                    <label for="basic-url"><span style="font-size: 18px;"><strong>Product Estimated Shipping
                                                Time</strong></span></label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                        </div>
                                        <input type="text" class="form-control" placeholder="Estimated Shipping Time"
                                            aria-label="Product Name" aria-describedby="basic-addon1" name="ship" value="{{old('ship')}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <label for="basic-url"><span style="font-size: 18px;"><b>Product Regular Price(required)</b></span></label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            {{-- <span class="input-group-text">@</span> --}}
                                        </div>
                                        <input type="number" min="0" step="0.01" class="form-control"
                                            placeholder="e.g 20" aria-label="Product" aria-describedby="basic-addon1"
                                            name="previous_price" value="{{ old('previous_price') }}">
                                    </div>
                                    @error('previous_price')
                                        <p class="form-text text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div class="col-lg-6 col-md-12">
                                    <label for="basic-url"><span style="font-size: 18px;"><b>Product
                                                offer price (Required)</b></span> (Product
                                        BDT)</label>
                                    <div class="input-group ">
                                        <div class="input-group-prepend">
                                            {{-- <span class="input-group-text">Shirt</span> --}}
                                        </div>
                                        <input type="number" min="0" step="0.01" class="form-control"
                                            placeholder="e.g 20" aria-label="Product Name" aria-describedby="basic-addon1"
                                            name="price" value="{{ old('price') }}">
                                    </div>
                                    @error('price')
                                        <p class="form-text text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
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
                                    
                                      @error('stock')
                                    <p class="form-text text-danger">{{ $message }}</p>
                                @enderror
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <label for="basic-url"><span style="font-size: 18px;"><strong>Product
                                                Description</strong></span></label>
                                     <div class="form-floating">
                                        <textarea class="form-control" placeholder="Enter Description"
                                            id="summernote" name="details">{{old('details')}}</textarea>
                                    </div>
                                     @error('details')
                                        <p class="form-text text-danger">{{ $message }}</p>
                                    @enderror
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
                                        style="font-size: 16px;"><strong>Create Product</strong></button>
                                </div>
                                <div class="col-md-4"></div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </form>
        
        <style>
            .img-thumbs {
  background: #eee;
  border-radius: 0.25rem;
  margin: 1.5rem 0;
  padding: 0 0.75rem;
}
.img-thumbs-hidden {
  display: none;
}

.wrapper-thumb {
  position: relative;
  display:inline-block;
  margin: 1rem 0;
  justify-content: space-around;
}

.img-preview-thumb {
  background: #fff;
  border: 1px solid none;
  border-radius: 0.25rem;
  box-shadow: 0.125rem 0.125rem 0.0625rem rgba(0, 0, 0, 0.12);
  margin-right: 1rem;
  max-width: 140px;
  padding: 0.25rem;
}

.remove-btn{
  position:absolute;
  display:flex;
  justify-content:center;
  align-items:center;
  font-size:.7rem;
  top:-5px;
  right:10px;
  width:20px;
  height:20px;
  background:white;
  border-radius:10px;
  font-weight:bold;
  cursor:pointer;
}

.remove-btn:hover{
  box-shadow: 0px 0px 3px grey;
  transition:all .3s ease-in-out;
}
        </style>
        
        <script>
            var imgUpload = document.getElementById('upload-img')
  , imgPreview = document.getElementById('img-preview')
  , imgUploadForm = document.getElementById('form-upload')
  , totalFiles
  , previewTitle
  , previewTitleText
  , img;

imgUpload.addEventListener('change', previewImgs, true);

function previewImgs(event) {
  totalFiles = imgUpload.files.length;
  
     if(!!totalFiles) {
    imgPreview.classList.remove('img-thumbs-hidden');
  }
  
  for(var i = 0; i < totalFiles; i++) {
    wrapper = document.createElement('div');
    wrapper.classList.add('wrapper-thumb');
    removeBtn = document.createElement("span");
    nodeRemove= document.createTextNode('x');
    removeBtn.classList.add('remove-btn');
    removeBtn.appendChild(nodeRemove);
    img = document.createElement('img');
    img.src = URL.createObjectURL(event.target.files[i]);
    img.classList.add('img-preview-thumb');
    wrapper.appendChild(img);
    wrapper.appendChild(removeBtn);
    imgPreview.appendChild(wrapper);
   
    $('.remove-btn').click(function(){
      $(this).parent('.wrapper-thumb').remove();
    });    

  }
  
  
}
        </script>
        
        

        


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

                let counter = 0;

                $('#size').html(`

                <div class="col-md-4">
                                            <label for="basic-url"><span style="font-size: 15px;"><strong>Size Name :</strong> (eg.
                                                    S,M,L,XL,XXL,3XL,4XL)
                                                </span></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                </div>
                                                <input type="text" class="form-control" placeholder="Size Name"
                                                    aria-label="Product Name" aria-describedby="basic-addon1" name="product_specification[${counter}][size]" required>
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
                                                    name="product_specification[${counter}][size_qty]" required>
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
                                                <input type="number" min="1" value="1" step="0.01" class="form-control"
                                                    placeholder="1" aria-label="Product Name"
                                                    aria-describedby="basic-addon1" name="product_specification[${counter}][size_price]" required>
                                            </div>
                                        </div>
                
                
                `);
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
                
                
                let incrementer = 1;
                
                 $('.spec').on('click', function(e){
                    e.preventDefault();
                    
                    let html =  `
                    
                    
                        <div class="row removeEl">
                                        
                          <div class="col-md-4">
                                    <label>Specification Title</label>
                                    <input name="specification[${incrementer}][title]" class="form-control" required>
                                </div>
                                
                                <div class="col-md-7">
                                    <label>Specification Details</label>
                                    <input name="specification[${incrementer}][details]" class="form-control" required>
                                </div>
                                
                                 <div class="col-md-1">
                                    <label class="w-100"></label>
                                    <button type="button" class="btn btn-danger remove"> <i class="fa fa-trash"></i> </button>
                                </div>
                        </div>
                    
                    
                    `;
                    
                    
                    $('.appear').append(html);
                    
                    
                    incrementer++;
                    
                    
                    
                })
                
                
                $(document).on('click','.remove' ,function(){
                    $(this).closest('.removeEl').remove();
                })
                
                
                
                
                
                let counter = 1;
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
                                                    aria-label="Product Name" aria-describedby="basic-addon1" name="product_specification[${counter}][size]" required>
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
                                                    name="product_specification[${counter}][size_qty]" required>
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
                                                <input type="number" min="1" value="1" step="0.01" class="form-control"
                                                    placeholder="0" aria-label="Product Name"
                                                    aria-describedby="basic-addon1" name="product_specification[${counter}][size_price]" required>
                                            </div>
                                        </div>

                                    </div>

                    `);

                    counter++;

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



<script type="text/javascript">

    $(document).ready(function() {
        $('select[name="subcategory_id"]').attr('disabled', 'disabled');
        $('select[name="childcategory_id"]').attr('disabled', 'disabled');
       // $('select[name="subcategory_id"]').disabled();
        $('select[name="category_id"]').on('change', function() {
            var catID = $(this).val();

            $('select[name="childcategory_id"]').attr('disabled', 'disabled');
                        $('select[name="childcategory_id"]').empty();

            if(catID) {
                $.ajax({
                    url: '/findsub/'+catID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        console.log(data)
                        $('select[name="subcategory_id"]').removeAttr('disabled');
                        $('select[name="subcategory_id"]').empty();

                        if(data.length>0){
                            $('select[name="subcategory_id"]').append('<option value="">Select Subcategory</option>');
                        $.each(data, function(key, value) {

                            console.log(value)
                            $('select[name="subcategory_id"]').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                        });
                    }else{

                        $('select[name="subcategory_id"]').append('<option value="0">'+ 'Not Found' +'</option>');

                    }


                    }
                });
            }else{
                $('select[name="subcategory_id"]').attr('disabled', 'disabled');
            }
        });




        $('select[name="subcategory_id"]').on('change', function() {
            var ccatID = $(this).val();

            if(ccatID) {
                $.ajax({
                    url: '/findchild/'+ccatID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        console.log(data)
                        $('select[name="childcategory_id"]').removeAttr('disabled');
                        $('select[name="childcategory_id"]').empty();

                        if(data.length>0){
                            $('select[name="childcategory_id"]').append('<option value="">Select Child Category</option>');
                        $.each(data, function(key, value) {

                            console.log(value)
                            $('select[name="childcategory_id"]').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                        });
                    }else{

                        $('select[name="childcategory_id"]').append('<option value="0">'+ 'Not Found' +'</option>');

                    }


                    }
                });
            }else{
                $('select[name="childcategory_id"]').attr('disabled', 'disabled');
            }
        });


    });
</script>



    </div>
@endsection



@push('scripts')
    <script>

        $('.categoryId').on('change', function(){
            
            getCategoryProductType($(this).val())  
        })
        

        
       $(document).on("keyup",".qty_stock" ,function(){
          
            var sum=0;
            $(".qty_stock").each(function(){
                if($(this).val() != "")
                  sum += parseInt($(this).val());   
            });
        
            $('input[name=stock]').val(sum)
        });
        
        
        $(document).on('change', '.attribute_check', function(){
            
            $('input[name=stock]').attr('readonly','readonly')
            
            
            var numberOfChecked = $('.attribute_check:checked').length;
            
            
        
            if(numberOfChecked == 0){
                $('input[name=stock]').prop('readonly', false);
            }
            
          
              
        })
        
        


        function getCategoryProductType(category_id) {
           
            $.ajax({
                type: "GET",
                url: "{{ route('attribute.fetch') }}",
                data: {
                    "category_id": category_id
                },
                datatype: "json",
                success: function(response) {

                    var attributes = response.attributes

                    let counter = 0;

                    var html = attributes.map(function(opt) {
                        let options = '';

                        for (let index = 0; index < opt.options.length; index++) {
                            options += `

                        <div class="col-md-12"> 
                            <div class="d-flex flex-wrap align-items-center">  
                                <div class="col-md-4">
                                    <label class="container">${opt.options[index].option}
                                        <input type="hidden" value="${opt.id}" name="product_specification[${counter}][category_attribute_id]">
                                        <input type="checkbox" name="product_specification[${counter}][attribute]"  value="${opt.options[index].id}" class="attribute_check">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="col-md-4">
                                    <label for="">Qty <input type="number" class="form-control qty_stock" name="product_specification[${counter}][qty_attr]" value="0"></label>
                                    
                                </div>
                                <div class="col-md-4">
                                    <label for="">Price <input type="number" class="form-control" name="product_specification[${counter}][price_attr]" value="0"></label>
                                </div>
                            </div>
                        </div>

        `
        counter++;
                        }

                        return `

                            <div class="col-md-6 my-3">
                                <h3>${opt.name}</h3>
                                ${options}
                            </div>


    `;



                    }).join('');


                    $('.appearAttributes').html(html);
                }
            });
        }
    </script>
@endpush
