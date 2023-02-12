var tableRow = '';
//Show edit form with data ajax request
$(document).ready(function () {
    $(document).on('click','.editBtn',function () {
        const id = $(this).attr('data-id');
        tableRow = $(this).parent().parent();
        $('#product-id').val(id);
        $('.editCatImageError').text('');
        $('.editFeaturedImageError').text('');

        $.ajax({
            type: 'GET',
            url: `/admin/product/${id}/edit`,
            success: (data) => {
                $('#edit-name').val(data.name);
                $('#edit-sku').val(data.sku);
                $('#edit-categoryId').val(data.category_id);
                $('#edit-subcategoryId').val(data.subcategory_id);
                $('#oldPhoto').attr('src',`../../uploads/category-images/${data.photo}`);
                $('.is_featured').prop('checked',false);
                $('.feature-category').attr('hidden',true);
                $('.dropify-clear').click();
                if (data.is_featured == 1){
                    $('#oldImage').attr('src',`../../uploads/category-images/featured/${data.image}`);
                }
                $('#edit-price').val(data.price);
                $('#edit-stock').val(data.stock);
            },
            error: (error) => {
                console.log(error);
            }
        })
    });
});

//Update Category Ajax
$(document).ready(function () {
    $(document).on('submit','#edit-category-form',function (e) {
        e.preventDefault();
        const id = $('#category-id').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: `/admin/category/${id}/update`,
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function (data) {
                $('#edit-name').val('');
                $('#edit-slug').val('');
                $('.edit-image').val('');
                $('.edit-photo').val('');
                $('.is_featured').prop('checked',false);
                $('.feature-category').attr('hidden',true);
                $('.closeBtn').click();
                $('.dropify-clear').click();
                toastr.options = {
                    "timeOut": "2000",
                    "closeButton": true,

                };
                toastr['success']('Category Successfully Updated!!!');
                console.log(data);
                const a = $(tableRow).find('td');
                $(a[0]).text(data.name);
                $(a[1]).text(data.slug);


            },
            error: function (error) {
                console.log(error);
                if (typeof(error.responseJSON.errors.photo) !== "undefined"){
                    $('.editCatImageError').text(error.responseJSON.errors.photo[0]);
                }else{
                    $('.editCatImageError').text('');
                }
                if (typeof(error.responseJSON.errors.image) !== "undefined"){
                    $('.editFeaturedImageError').text(error.responseJSON.errors.image[0]);
                }else{
                    $('.editFeaturedImageError').text('');
                }
            }
        })
    });
});


//Status update ajax
$(document).ready(function () {
    $(document).on('change','#selectStatus',function () {
        let status = $(this).val();
        let id = $(this).attr('data-id');
        $.ajax({
            type: 'GET',
            url: `/admin/product/${id}/status/update`,
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

function appendTableRow(data) {
    $('tbody').append(`
    <tr>
    <td>${data.name}<br> <small>Id: ${data.id}</small> <small>SKU:
    ${data.sku}</small> <small>Vendor: </small></td>
    <td>Physical</td>
    <td>${data.stock}</td>
    <td>${data.price}BDT</td>
    <td>0BDT</td>
    <td>
        <select name="" data-id="${data.id}" class="selectStatus">
            <option value="1"  ${data.status == 1 ? 'selected' : ''}>Active</option>
            <option value="0" ${data.status == 0 ? 'selected' : ''}>Deactive</option>
        </select>
    </td>
    <td>
        <button data-id="${data.id}" data-toggle="modal" data-target="#editSubCategoryModal" class="btn btn-primary btn-round mr-1 editBtn" style="cursor: pointer" type="button"><i class="fa fa-edit"></i> Edit</button>
        <button data-id="${data.id}" class="btn btn-danger btn-round deleteBtn" style="cursor: pointer" type="submit"><i class="fa fa-trash"></i></button>
    </td>

</tr>
    `);
    $('select').niceSelect();
}



//Status update ajax
$(document).ready(function () {
    $(document).on('change','#selectStatusv',function () {
        let status = $(this).val();
        let id = $(this).attr('data-id');
        $.ajax({
            type: 'GET',
            url: `/vendor/product/${id}/status/update`,
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

//is featured update
$(function (){
    $(document).on('change','#selectIsFeatured',function (){
        const id = $(this).attr('data-id');
        const status = $(this).val();
        $.ajax({
            type: 'GET',
            url: `/admin/product/${id}/featured/update`,
            data: {'featured' : status},
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
})

function appendTableRow(data) {
    $('tbody').append(`
    <tr>
    <td>${data.name}<br> <small>Id: ${data.id}</small> <small>SKU:
    ${data.sku}</small> <small>Vendor: </small></td>
    <td>Physical</td>
    <td>${data.stock}</td>
    <td>${data.price}BDT</td>
    <td>0BDT</td>
    <td>
        <select name="" data-id="${data.id}" class="selectStatus">
            <option value="1"  ${data.status == 1 ? 'selected' : ''}>Active</option>
            <option value="0" ${data.status == 0 ? 'selected' : ''}>Deactive</option>
        </select>
    </td>
    <td>
        <button data-id="${data.id}" data-toggle="modal" data-target="#editSubCategoryModal" class="btn btn-primary btn-round mr-1 editBtn" style="cursor: pointer" type="button"><i class="fa fa-edit"></i> Edit</button>
        <button data-id="${data.id}" class="btn btn-danger btn-round deleteBtn" style="cursor: pointer" type="submit"><i class="fa fa-trash"></i></button>
    </td>

</tr>
    `);
    $('select').niceSelect();
}

