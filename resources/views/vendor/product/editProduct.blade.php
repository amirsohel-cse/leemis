@extends('vendor.layout.master.master')


@section('main-content')
    <div class="div1">
        <div class="row my-4">
            <div class="col-md-12">
            </div>

        </div>

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

        @if (Session::get('success'))
            <div class="alert text-white container" style="background: #3daa1b;">
                {{ Session::get('success') }}
            </div>
        @endif
        <form method="post" action="{{ route('productUpdatevendor', $product->id) }}" enctype="multipart/form-data">
            @csrf
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12">
                    <div class="card">

                        <div class="body">
                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <label for="basic-url"><span style="font-size: 18px;"><b>Product Name</b></span>
                                    </label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                        </div>
                                        <input type="text" class="form-control" placeholder="Enter Product Name"
                                            aria-label="Username" aria-describedby="basic-addon1" name="name"
                                            value="{{ $product->name }}">
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
                                            aria-label="Product" aria-describedby="basic-addon1" name="sku"
                                            value="{{ $product->sku }}">
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
                                                <option {{ $product->category_id == $row->id ? 'selected' : '' }}
                                                    value="{{ $row->id }}">{{ $row->name }}</option>
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
                                                <option {{ $product->subcategory_id == $row->id ? 'selected' : '' }}
                                                    value="{{ $row->id }}">{{ $row->name }}</option>
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
                                        <select class="form-control" name="childcategory_id" id="categoryId">
                                            <option value="" data-display="Select">Select Category</option>
                                            @forelse($childcategories as $row)
                                                <option {{ $product->childcategory_id == $row->id ? 'selected' : '' }}
                                                    value="{{ $row->id }}">{{ $row->name }}</option>
                                            @empty
                                                <option value="">No Categories Added</option>
                                            @endforelse
                                        </select>

                                    </div>
                                </div>
                                @error('childcategory_id')
                                    <p class="form-text text-danger">{{ $message }}</p>
                                @enderror
                                <div class="col-md-6">

                                    <label for="basic-url"><span style="font-size: 18px;"><b>Brand</b></span></label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                        </div>
                                        <select class="form-control" name="brand_id" id="subcategoryId">
                                            <option value="" data-display="Select">Select Subcategory</option>
                                            @forelse($brand as $row)
                                                <option {{ $product->brand_id == $row->id ? 'selected' : '' }}
                                                    value="{{ $row->id }}">{{ $row->name }}</option>
                                            @empty
                                                <option value="">No Brand Added</option>
                                            @endforelse
                                        </select>

                                    </div>
                                    @error('brand_id')
                                        <p class="form-text text-danger">{{ $message }}</p>
                                    @enderror
                                </div>


                                @php
                                    $attributeIds = collect($product->product_specification)->pluck('category_attribute_id')->toArray();

                                    $optionIds = collect($product->product_specification)->pluck('attribute')->toArray();


                                    $dataPrice = collect($product->product_specification);
                                    
                                    
                                @endphp


                                <div class="col-md-12">
                                    <div class="row appearAttributes">
                                        @foreach ($attributes as $attr)
                                            <div class="col-md-6 my-3">
                                                <h3>{{$attr->name}}</h3>
                                                <div class="col-md-12">
                                                    <div class="d-flex flex-wrap align-items-center">
                                                        @foreach ($attr->options as $option)
                                                            
                                                        <div class="col-md-4">
                                                            <label class="container">{{$option->option}}
                                                                <input type="hidden" value="{{$attr->id}}" name="product_specification[{{$option->id}}][category_attribute_id]">
                                                                <input type="checkbox"  name="product_specification[{{$option->id}}][attribute]" value="{{$option->id}}" class="attribute_check" @if (in_array($attr->id , $attributeIds) && in_array($option->id, $optionIds)) checked @endif >
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </div>
                                                        
                                                        <div class="col-md-4">
                                                            <label for="">Qty <input type="number" class="form-control qty_stock"
                                                                    name="product_specification[{{$option->id}}][qty_attr]"
                                                                    value="{{$dataPrice->where('attribute', $option->id)->first() ? $dataPrice->where('attribute', $option->id)->first()['qty_attr'] : 0}}"></label>

                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="">Price <input type="number" class="form-control"
                                                                    name="product_specification[{{$option->id}}][price_attr]"
                                                                    value="{{$dataPrice->where('attribute', $option->id)->first() ? $dataPrice->where('attribute', $option->id)->first()['price_attr'] : 0}}"></label>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-12">
                                    <label for="basic-url"> <span style="font-size: 18px;"><b>Feature
                                                Image</b></span> (Image size should be 1000x1000 pixel)</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                        </div>
                                        <img class="img-fluid" src="{{ asset($product->photo) }}" id="fetureImage"
                                            height="60px" width="100%">
                                        <br>
                                        <br>
                                        <br>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="fetureInput" name="photo">
                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                        </div>
                                    </div>
                                    @error('photo')
                                        <p class="form-text text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                 <div class="col-lg-6 col-md-6">
                                    <label for="basic-url"> <span style="font-size: 18px;"><b>Product Gallery
                                        Images</b></span> (Image size should be 1000x1000 pixel)</label>
                                       
                                    <div id="form-upload">
                                        <div class="form-group">
                                            <input type="file" class="form-control" name="image_file[]" multiple id="upload-img" />
                                        </div>
                                        <div class="img-thumbs" id="img-preview">
                                             @foreach ($gallery as $data)
                                             <div class="wrapper-thumb"><img src="{{ asset('uploads') }}/product-gallery/{{ $data->image_file }}" class="img-preview-thumb"><span class="remove-btn">x</span></div>
                                            
                                        @endforeach
                                        </div>
                                    </div>
                                 @error('image_file')
                                        <p class="form-text text-danger">{{ $message }}</p>
                                    @enderror
                           

                            </div>

                            </div>
                            
                            
                            
                            
                            
                             <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-primary spec" type="button"> <i class="fa fa-plus"></i> Add New Specification</button>
                                </div>    
                                
                                <div class="col-md-12 appear">
                                @if($product->specification != null)
                                
                                @foreach($product->specification as $key=> $spec)
                                @php
                                    $last = $key + 1;
                                @endphp
                                @if($loop->first)
                                <div class="row">
                                    
                                 <div class="col-md-4">
                                    <label>Specification Title</label>
                                    <input name="specification[{{$key}}][title]" class="form-control" value="{{$spec['title']}}" required>
                                </div>
                                
                                <div class="col-md-8">
                                    <label>Specification Details</label>
                                    <input name="specification[{{$key}}][details]" class="form-control"  value="{{$spec['details']}}" required>
                                </div>
                                </div>
                                  @continue
                                @endif
                                
                                    <div class="row removeEl">
                                        
                                      <div class="col-md-4">
                                                <label>Specification Title</label>
                                                <input name="specification[{{$key}}][title]" class="form-control" value="{{$spec['title']}}" required>
                                            </div>
                                            
                                            <div class="col-md-7">
                                                <label>Specification Details</label>
                                                <input name="specification[{{$key}}][details]" class="form-control" value="{{$spec['details']}}" required>
                                            </div>
                                            
                                             <div class="col-md-1">
                                                <label class="w-100"></label>
                                                <button type="button" class="btn btn-danger remove"> <i class="fa fa-trash"></i> </button>
                                            </div>
                                    </div>
                           
                                

                                
                                @endforeach
                                
                                @else
                                
                                    <div class="col-md-4">
                                    <label>Specification Title</label>
                                    <input name="specification[0][title]" class="form-control"  required>
                                </div>
                                
                                <div class="col-md-8">
                                    <label>Specification Details</label>
                                    <input name="specification[0][details]" class="form-control"  required>
                                </div>
                                
                                @endif
                                
                                @error('specification.*.title')
                                        <p class="form-text text-danger">{{ $message }}</p>
                                @enderror
                                
                                 @error('specification.*.details')
                                        <p class="form-text text-danger">{{ $message }}</p>
                                @enderror
                                
                                
                                
                                 </div>
                               
                                
                            </div>





                            <div class="row my-5">

                                


                              


                               

                               
                                    <div class="my-3 col-md-12" id="field">

                                        <label for="basic-url"><span style="font-size: 18px;"><b>Product Estimated Shipping
                                                    Time</b></span></label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                {{-- <span class="input-group-text">Shirt</span> --}}
                                            </div>
                                            <input type="text" class="form-control" placeholder="Estimated Shipping Time"
                                                aria-label="Product Name" aria-describedby="basic-addon1" name="ship"
                                                value="{{ $product->ship }}">
                                        </div>
                                    </div>
                               
                                {{-- </div> --}}
                                {{-- <div class="col-md-4"></div> --}}
                            </div>
                            <div class="row">

                                <div class="col-lg-6 col-md-12">
                                    <label for="basic-url"><span style="font-size: 18px;"><b>Product Regular
                                                Price(required)</b></span>
                                    </label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            {{-- <span class="input-group-text">@</span> --}}
                                        </div>
                                        <input type="number" min="0" step="0.01" class="form-control"
                                            placeholder="e.g 20" aria-label="Product" aria-describedby="basic-addon1"
                                            name="previous_price" value="{{ $product->previous_price }}">
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
                                            name="price" value="{{ $product->price }}">
                                    </div>
                                    @error('price')
                                        <p class="form-text text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">

                            </div>
                            <div class="row">

                                <div class="col-lg-6 col-md-12">
                                    <label for="basic-url"><span style="font-size: 18px;"><b>Product Stock</b></span> (Leave
                                        Empty
                                        will Show Always Available)</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            {{-- <span class="input-group-text">Shirt</span> --}}
                                        </div>
                                        <input type="number" class="form-control" placeholder="e.g 20"
                                            aria-label="Product Name" aria-describedby="basic-addon1" name="stock"
                                            value="{{ $product->stock }}">
                                    </div>
                                </div>


                                <!--<div class="col-md-6">-->
                                <!--    <label for="">Offer Product</label>-->
                                <!--    <select name="offer" id="" class="form-control">-->
                                <!--        <option value="1" {{ $product->offer_product ? 'selected' : '' }}>Yes</option>-->
                                <!--        <option value="0" {{ $product->offer_product ? '' : 'selected' }}>No</option>-->
                                <!--    </select>-->
                                <!--</div>-->


                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <label for="basic-url"><span style="font-size: 18px;"><b>Product
                                                Description</b></span></label>
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Enter Description" id="summernote" name="details"
                                            s>{!! $product->details !!}</textarea>
                                    </div>
                                    @error('details')
                                        <p class="form-text text-danger">{{ $message }}</p>
                                    @enderror
                                </div>


                            </div>
                            <div class="row mt-3">
                                <div class="col-lg-6 col-md-12">
                                    <label for="basic-url"><span style="font-size: 18px;"><b>Youtube Video URL</b></span>
                                        (Optional)</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            {{-- <span class="input-group-text">Shirt</span> --}}
                                        </div>
                                        <input type="text" class="form-control" placeholder="Enter Youtube Video URL"
                                            aria-label="Product Name" aria-describedby="basic-addon1" name="youtube"
                                            value="{{ $product->youtube }}">
                                    </div>

                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <label for="basic-url"><span style="font-size: 18px;"><b>Tags</b></span> (Seperate with
                                        comma)</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            {{-- <span class="input-group-text">Shirt</span> --}}
                                        </div>
                                        <input type="text" class="form-control" aria-label="Product Name"
                                            aria-describedby="basic-addon1" name="tags" value="{{ $product->tags }}">
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
                                        style="font-size: 22px;"><b>Update Product</b></button>
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
  width: 140px;
  height: 140px;
  padding: 0.25rem;
  object-fit: cover;
  -o-object-fit: cover;
  object-position: cover;
  -o-object-position: cover;
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
                integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#summernote').summernote();
                
                $(document).on('click','.remove-btn',function(){

    
  $(this).parent('.wrapper-thumb').remove();
});  
            });
        </script>
    </div>
    <script type="text/javascript">
        fetureInput.onchange = evt => {
            const [file] = fetureInput.files
            if (file) {
                fetureImage.src = URL.createObjectURL(file)
            }
        }
    </script>

    <script type="text/javascript">
        fetureInputGallery.onchange = evt => {
            const [file] = fetureInputGallery.files
            if (file) {
                galleryInput.src = URL.createObjectURL(file)
            }
        }
    </script>

    <script>
        $(function() {
            let counter = "{{ count($product->product_specification ?? [0]) }}"
            $('#addSizeBtn').on('click', function() {
                $('#size_name').append(`
                    <input type="text" class="form-control" placeholder="Size Name"
                     aria-label="Product Name" aria-describedby="basic-addon1" name="product_specification[${counter}][size]" value="" required><br>
                `);

                $('#size_qty').append(`
                    <input type="text" class="form-control" placeholder="Size Qty"
                         aria-label="Product Name" aria-describedby="basic-addon1"
                         name="product_specification[${counter}][size_qty]" value="" required> <br>
                `);

                $('#size_price').append(`
                <div class="col-md-9">
                <div>
                    <input type="txt" min="0"  step="0.01" class="form-control"
                           placeholder="0" aria-label="Product Name"
                           aria-describedby="basic-addon1" name="product_specification[${counter}][size_price]" required> <br>
                </div>
                </div>
                <div class="col-md-3">
                        <button type="button" class="btn btn-sm btn-danger remove-row"><i class="fa fa-minus"></i></button>
                </div>
                `);
                counter++;
            })
        });

        $(document).ready(function() {
            $(document).on('click', '.remove-row', function() {
                let sizeName = $('#size_name input');
                let sizeBr = $('#size_name br');
                sizeName[$(sizeName).length - 1].remove();
                sizeBr[$(sizeBr).length - 1].remove();

                let sizeQty = $('#size_qty input');
                let sizeQtyBr = $('#size_qty br');
                sizeQty[$(sizeQty).length - 1].remove();
                sizeQtyBr[$(sizeQtyBr).length - 1].remove();

                $(this).parent().prev().remove();
                $(this).parent().remove();
            });
        });
        
        
        
         let incrementer = "{{$last}}";
                
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
                

        $(function() {
            $('#moreColorBtn').on('click', function() {
                $('#addMoreColor').append(`
                <div class="col-md-5 mt-2">
                <input type="text" width="80%" value="" class="form-control" placeholder="Enter Product Color"
                    aria-label="Product Name" aria-describedby="basic-addon1" name="color[]" >
                </div>
                <div class="col-md-1 mt-2">
                    <button type="button" class="btn btn-sm btn-danger removeColorBtn"><i class="fa fa-minus"></i></button>
                </div>
`);
            });

            $(document).on('click', '.removeColorBtn', function() {
                $(this).parent().prev().remove();
                $(this).parent().remove();
            });
        })
    </script>


@endsection


@push('scripts')
    <script>

        $('.categoryId').on('change', function(){
            
            getCategoryProductType($(this).val())  
        })
        
        
        var numberOfChecked = $('.attribute_check:checked').length;
            
        if(numberOfChecked > 0){
            $('input[name=stock]').attr('readonly', 'readonly');
        }
        
        
        $(document).on("keyup",".qty_stock" ,function(){
          
            var sum=0;
            $(".qty_stock").each(function(){
                if($(this).val() != "")
                  sum += parseInt($(this).val());   
            });
        
            $('input[name=stock]').val(sum)
        });


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
    </script>
@endpush
