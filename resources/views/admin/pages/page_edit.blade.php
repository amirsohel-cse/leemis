@extends('admin.layout.master.master')


@section('main-content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">

                        <div class="row">

                            <form action="" method="POST" class="col-md-12">
                                @csrf
                                <div class="row">

                                    


                                    <div class="form-group col-md-6 {{ $page->name == 'home' ? 'd-none' : '' }}">

                                        <label for="">{{ __('Page Name') }}</label>

                                        <input type="text" name="page" class="form-control" required
                                            value="{{ $page->name }}">

                                    </div>

                                   

                                    <div class="form-group col-md-6 {{ $page->name == 'home' ? 'd-none' : '' }}">

                                        <label for="">{{ __('status') }}</label>

                                        <select name="status" class="form-control">

                                            <option value="1" {{ $page->status ? 'selected' : '' }}>
                                                {{ __('Active') }}</option>
                                            <option value="0" {{ $page->status ? '' : 'selected' }}>
                                                {{ __('Inactive') }}</option>

                                        </select>

                                    </div>

                                   

                                  

                                    <div
                                        class="form-group col-md-12 custom-section {{ $page->custom_section_data != null ? '' : 'd-none' }}">

                                        <label for="">{{ __('Custom Section') }}</label>
                                        <textarea name="custom_section" id="" cols="30" rows="5"
                                            class="form-control summernote">{{ $page->custom_section_data ?? old('custom_section') }}</textarea>

                                    </div>


                                    <div class="col-md-12">
                                        <button type="submit"
                                            class="btn btn-primary float-right">{{ __('Update Page') }}</button>
                                    </div>



                                </div>


                            </form>




                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-scripts')
    <script>
        $('.summernote').summernote({
            placeholder: 'Type your message',
            tabsize: 1,
            height: 300
        });
    </script>
@endsection
