$(function (){
   $('#addPixelBtn').on('click',function (){
       $.ajax({
           type: 'GET',
           url: '/admin/setting/pixel/details',
           success: (data) => {
               if (Object.keys(data).length !== 0){
                   $('#facebook_account_name').val(data.facebook_account_name);
                   $('#pixel_name').val(data.pixel_name);
                   $('#pixel_id').val(data.pixel_id);
               }
           }
       })
   }) ;

   $('#add-pixel-form').on('submit',function (e){
       e.preventDefault();
       let form = document.getElementById('add-pixel-form');
       let formData = new FormData(form);

       $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           contentType: false,
           processData: false
       });

       $.ajax({
           type: 'POST',
           url: '/admin/setting/pixel/store',
           data: formData,
           success: (data) => {
               let td = $('td');
               $(td[0]).text(formData.get('facebook_account_name'));
               $(td[1]).text(formData.get('pixel_name'));
               $(td[2]).text(formData.get('pixel_id'));

               toastr.options = {
                   "timeOut": "2000",
                   "closeButton": true,
               };
               toastr['success'](data);

               $('.close').click();
           },
           error: (error) => {
               console.log(error);
           }

       })
   })
});
