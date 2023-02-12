@extends('admin.layout.master.master')

@section('main-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header justify-content-between">
                <div>
                    <h1>{{ __(@$pageTitle) }}</h1>
                </div>

            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped dataTable" id="example">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Sl') }}</th>
                                            <th>{{ __('Attribute Name') }}</th>
                                            <th>{{ __('Attributes') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($category->attributes as $attribute)
                                     
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $attribute->name }}</td>
                                                <td>
                                                    @foreach ($attribute->options as $item)
                                                        <span class="badge badge-primary">

                                                            {{ $item->option }}
                                                        </span>
                                                    @endforeach
                                                </td>

                                                <td>
                                                    <button data-href="{{ route('category-attributes-edit', $category->id) }}"
                                                        class="btn btn-primary btn-attr" data-attr="{{$attribute}}" data-attr_id="{{$attribute->id}}"><i
                                                            class="fa fa-edit"></i></button>

                                                    <button data-href="{{ route('category-attributes-delete', $attribute->id) }}"
                                                        class="btn btn-danger delete"><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>


    <div class="modal fade" tabindex="-1" role="dialog" id="attribute">
        <div class="modal-dialog modal-lg" role="document">
            <form action="" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal Attribute</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" name="attribute_id">
                            <div class="col-md-12">
                                <label for="">Name</label>
                                <input type="text" name="name" class="form-control">
                            </div>

                            <div class="col-md-12 my-3">
                                <button class="btn btn-primary addnew" type="button"> <i class="fa fa-plus"></i> Add New
                                    Option</button>
                            </div>

                        </div>

                        <div class="row appear">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="delete_modal">
      <div class="modal-dialog" role="document">
          <form action="" method="post">
              @csrf
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Delete Attribute</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Are You Sure to Delete this Attribute</p>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-danger">Delete</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </div>
          </form>
      </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('.btn-attr').on('click', function(e) {
            e.preventDefault();

            const modal = $('#attribute');

            modal.find('form').attr('action', $(this).data('href'))
            modal.find('input[name=name]').val($(this).data('attr').name)
            modal.find('input[name=attribute_id]').val($(this).data('attr_id'))

            let html = '';
            
            for (let index = 0; index < $(this).data('attr').options.length; index++) {
                
                 html += `
                    
                    <div class="col-md-12 removeEl my-2">
                                <label for="">Options  <button class="btn btn-danger remove">X</button></label>
                                <input type="text" name="options[]" class="form-control" value="${$(this).data('attr').options[index].option}">
                            </div>
                    
                    `;
                
            }

            $('.appear').html(html)



            modal.modal('show');

        })


        $('.addnew').on('click', function() {
            let html = `

            <div class="col-md-12 removeEl my-2">
                                <label for="">Options <button class="btn btn-danger remove">X</button> </label>
                                <input type="text" name="options[]" class="form-control">
                            </div>
            
            `;


            $('.appear').append(html)
        })


        $(document).on('click', '.remove', function(e) {
            e.preventDefault();

            $(this).closest('.removeEl').remove();
        })

        $('.delete').on('click', function(){
            const modal = $('#delete_modal')

            modal.find('form').attr('action', $(this).data('href'));
            modal.modal('show')
        })
    </script>
@endpush
