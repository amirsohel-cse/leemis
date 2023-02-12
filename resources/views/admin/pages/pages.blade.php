@extends('admin.layout.master.master')


@section('main-content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-end bg-primary text-white">
                <a href="{{ route('frontend.pages.create') }}" class="btn btn-icon icon-left btn-success add-page"> <i class="fa fa-plus"></i> {{ __('Add Page') }}</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>

                            <tr>
                                <th>{{ __('Sl') }}</th>
                                <th>{{ __('Page Name') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($pages as $key => $page)
                                <tr>
    
                                    <td>
                                        {{ $key + $pages->firstItem() }}
                                    </td>
                                    <td>
                                        {{ $page->name }}
                                    </td>
    
                                    <td>
    
                                        <a href="{{ route('frontend.pages.edit', $page) }}"
                                            class="btn btn-icon btn-primary edit"><i class="fa fa-edit"></i></a>
                                       
                                            <a href="#" class="btn btn-icon btn-danger delete"
                                                data-url="{{ route('frontend.pages.delete', $page) }}"><i
                                                    class="fa fa-trash"></i></a>
                                        
                                    </td>
                                </tr>
                            @empty
                            @endforelse

                        </tbody>


                    </table>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" tabindex="-1" role="dialog" id="deleteModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Delete Page') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        @csrf

                        <p>{{ __('Are You Sure To Delete Pages') }}?</p>

                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary mr-3"
                                data-dismiss="modal">{{ __('Close') }}</button>
                            <button type="submit" class="btn btn-danger">{{ __('Delete Page') }}</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>


@endsection


@push('scripts')
    <script>
        'use strict'

        $(function() {

            $('.delete').on('click', function() {
                const modal = $('#deleteModal');

                modal.find('form').attr('action', $(this).data('url'))
                modal.modal('show')
            })
        })
    </script>
@endpush
