@extends('admin.layout.master.master')

@section('main-content')


@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-header">
                    <button type="button" data-toggle="modal" data-target="#adModal" class="btn btn-primary mr-3 mt-2"><i class="la la-plus"></i>@lang('Ad New')</button>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive--md  table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                            <tr>
                                <th scope="col">@lang('Advertisement Type')</th>
                                <th scope="col">@lang('Ad Size')</th>
                                <th scope="col">@lang('Ad Image')</th>
                                <th scope="col">@lang('Status')</th>
                                <th scope="col">@lang('Action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($advertisements as $advr)
                            <tr>
                                <td data-label="@lang('Advertisement Type')"><span class="text-small badge font-weight-normal {{$advr->type == 1 ? 'badge--success':'badge-primary'}}">{{$advr->type == 1 ? 'Banner':'Script'}}</span></td>
                                <td data-label=">@lang('Resolution')"><span class="text-small badge font-weight-normal badge--primary">{{$advr->resolution}}</span></td>
                                @if ($advr->type == 1)
                                  <td data-label="@lang('Ad Image')"> <a class="btn btn-sm btn-dark" href="{{getImage('assets/images/advertisement/'.$advr->ad_image)}}"  data-rel="lightcase"> <i class="las la-eye"></i> @lang('see')</a></td>
                                @else
                                   <td @lang('Ad Image')> @lang('N/A')</td>
                                @endif


                                <td data-label="@lang('Status')"><span class="text-small badge font-weight-normal {{$advr->status == 1 ? 'badge--success':'badge-warning'}}">{{$advr->status == 1 ? 'active':'inactive'}}</span></td>

                                <td data-label="Action">
                                    <a href="javascript:void(0)" data-advr="{{$advr}}" data-route="{{route('advertisements.update',$advr->id)}}" class="btn btn-primary mr-2 edit" data-toggle="tooltip" title="@lang('Edit')">
                                        <i class="fa fa-edit text--shadow"></i>
                                    </a>
                                    <a href="javascript:void(0)" data-route="{{route('advertisements.remove',$advr->id)}}" class="btn btn-danger delete" data-toggle="tooltip" title="@lang('Delete')">
                                        <i class="fa fa-trash text--shadow"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">{{ $empty_message }}</td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
                <div class="card-footer py-4">
                 {{$advertisements->links()}}
                </div>
            </div><!-- card end -->
        </div>


        <div class="modal fade" id="adModal" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog" role="document">
               <form action="{{route('advertisements.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header bg--primary">
                        <h5 class="modal-title ">@lang('Ad new advertisement')</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                         <div class="form-group">
                            <label >@lang('Fixed Slider Advertisement ')</label>
                            <select class="form-control" name="is_slider" required>
                                <option value="0">@lang('No')</option>
                                <option value="1">@lang('Yes')</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label >@lang('Select Type')</label>
                            <select class="form-control type" name="type" required>
                                <option value="1">@lang('Banner')</option>
                                <option value="2">@lang('Script')</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label >@lang('Select Ad Size')</label>
                            <select class="form-control" name="size" required>
                                <option value="160x230">@lang('160x230')</option>
                                <option value="224x295">@lang('224x295')</option>
                                <option value="356x221">@lang('356x221')</option>
                                <option value="356x250">@lang('356x250')</option>
                                <option value="442x165">@lang('442x165')</option>
                                <option value="710x185">@lang('710x185')</option>
                                <option value="1440x250">@lang('1440x250')</option>
                                <option value="1440x80">@lang('1440x80')</option>
                                
                            </select>
                        </div>
                        <div class="form-group ru">
                            <label >@lang('Redirect Url')</label>
                            <input type="text" class="form-control" name="redirect_url" placeholder="@lang('http/https://example.com')" required value="{{old('redirect_url')}}">
                        </div>

                        <div class="form-group adfile">
                            <label >@lang('Ad Image')</label>
                            <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold"> <input type="file" class="form-control-file" name="adimage" required id="img"> </li>
                        </div>

                        <div class="form-group script d-none">
                            <label >@lang('Ad Script')</label>
                            <textarea type="text" class="form-control" disabled name="script" required>{{old('script')}}</textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label font-weight-bold">@lang('Status') </label>
                            <input type="checkbox" data-width="100%" data-onstyle="success" data-offstyle="danger"
                                   data-toggle="toggle" data-on="@lang('Active')" data-off="@lang('Inactive')" name="status"
                                  >
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn-primary">@lang('Save')</button>
                    </div>
                </div>
               </form>
            </div>
        </div>


        <div class="modal fade" id="editModal" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog" role="document">
               <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title ">@lang('Edit Advertisement')</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label >@lang('Fixed Slider Advertisement ')</label>
                            <select class="form-control" name="is_slider" required>
                                <option value="0">@lang('No')</option>
                                <option value="1">@lang('Yes')</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label >@lang('Select Type')</label>
                            <select class="form-control type" name="type" required readonly>
                                <option value="1">@lang('Banner')</option>
                                <option value="2">@lang('Script')</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label >@lang('Select Ad Size')</label>
                            <select class="form-control" name="size" required>
                                <option value="160x230">@lang('160x230')</option>
                                <option value="224x295">@lang('224x295')</option>
                                <option value="356x221">@lang('356x221')</option>
                                <option value="356x250">@lang('356x250')</option>
                                <option value="442x165">@lang('442x165')</option>
                                <option value="710x185">@lang('710x185')</option>
                                <option value="1440x250">@lang('1440x250')</option>
                                <option value="1440x80">@lang('1440x80')</option>
                            </select>
                        </div>
                        <div class="form-group ru">
                            <label >@lang('Redirect Url')</label>
                            <input type="text" class="form-control" name="redirect_url" placeholder="@lang('http/https://example.com')" required value="{{old('redirect_url')}}">
                        </div>

                        <div class="form-group adfile">
                            <label >@lang('Ad Image')</label>
                            <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold"> <input type="file" class="form-control-file" name="adimage" id="img"> </li>
                        </div>

                        <div class="form-group script d-none">
                            <label >@lang('Ad Script')</label>
                            <textarea type="text" class="form-control" disabled name="script" required>{{old('script')}}</textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label font-weight-bold">@lang('Status') </label>
                            <input type="checkbox" data-width="100%" data-onstyle="success" data-offstyle="danger"
                                   data-toggle="toggle" data-on="@lang('Active')" data-off="@lang('Inactive')" name="status"
                                  >
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn-primary">@lang('Save')</button>
                    </div>
                </div>
               </form>
            </div>
        </div>


    {{-- delete modal --}}
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
               <button type="button" class="close ml-auto m-3" data-bs-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
                    <form action="" method="POST">
                        @csrf
                        <div class="modal-body text-center">

                            <i class="las la-exclamation-circle text-danger display-2 mb-15"></i>
                            <h4 class="text-secondary mb-15">@lang('Are You Sure Want to Delete This?')</h4>

                        </div>
                    <div class="modal-footer justify-content-center">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('close')</button>
                      <button type="submit"  class="btn btn-danger del">@lang('Delete')</button>
                    </div>

                    </form>
              </div>
            </div>
        </div>
    </div>
@endsection



@push('page-stylesheet')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightcase/2.5.0/css/lightcase.css"/>
@endpush

@section('page-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightcase/2.5.0/js/lightcase.min.js"></script>
@endsection

@push('scripts')

     <script>
            'use strict';
            (function ($) {
                $('.type').on("change",function () {
                    if($(this).val() == 1){
                        $('.ru').removeClass('d-none')
                        $('.ru').find('input[name=redirect_url]').attr('disabled',false)
                        $('.adfile').removeClass('d-none')
                        $('.adfile').find('input[name=adimage]').attr('disabled',false)
                        $('.script').addClass('d-none')
                        $('.script').find('textarea[name=script]').attr('disabled',true)
                    } else if($(this).val() == 2) {
                        $('.ru').addClass('d-none')
                        $('.ru').find('input[name=redirect_url]').attr('disabled',true)
                        $('.previmage').addClass("d-none")
                        $('.adfile').addClass('d-none')
                        $('.adfile').find('input[name=adimage]').attr('disabled',true)
                        $('.script').removeClass('d-none')
                        $('.script').find('textarea[name=script]').attr('disabled',false)
                    }
                })
                $('.edit').on('click',function () {
                    var modal = $('#editModal')
                    var advr = $(this).data('advr')
                    var route = $(this).data('route')
                    modal.find('select[name=type]').val(advr.type)
                    modal.find('select[name=is_slider]').val(advr.is_slider)
                    modal.find('select[name=size]').val(advr.resolution)
                    if(advr.redirect_url){
                      modal.find('input[name=redirect_url]').val(advr.redirect_url)
                    }
                    if(advr.script != null){
                        $('.ru').addClass('d-none')
                        $('.ru').find('input[name=redirect_url]').attr('disabled',true)
                        $('.previmage').addClass("d-none")
                        $('.adfile').addClass('d-none')
                        $('.adfile').find('input[name=adimage]').attr('disabled',true)
                        $('.script').removeClass('d-none')
                        $('.script').find('textarea[name=script]').attr('disabled',false)
                        modal.find('textarea[name=script]').val(advr.script)
                    } else {
                        $('.ru').removeClass('d-none')
                        $('.ru').find('input[name=redirect_url]').attr('disabled',false)
                        $('.adfile').removeClass('d-none')
                        $('.adfile').find('input[name=adimage]').attr('disabled',false)
                        $('.script').addClass('d-none')
                        $('.script').find('textarea[name=script]').attr('disabled',true)
                    }
                    if(advr.status == 1){
                      modal.find('input[name=status]').bootstrapToggle('on')
                    }
                    modal.find('form').attr('action',route)
                    modal.modal('show')
                })
                $('.delete').on('click',function(){
                    var route = $(this).data('route')
                    var modal = $('#deleteModal');
                    modal.find('form').attr('action',route)
                    modal.modal('show');
                })
                $('a[data-rel^=lightcase]').lightcase();
            })(jQuery);
     </script>

@endpush