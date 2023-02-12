@extends('admin.layout.master.master')

@section('main-content')
<div class="col-lg-10 offset-md-1">
    <div class="card">
        <div class="header">
            <h2><strong>Group Mail</strong></h2>
        </div>
        <div class="body">
            <form action="{{ route('sendEmail') }}" method="post">
                @csrf
                <div class="form-group">
                    <h6><strong>Select User Type*</strong></h6>
                    <div class="input-group">
                        <select class="custom-select" id="inputGroupSelect04" name="emailGroup">
                            <option selected="">Choose user type</option>
                            <option value="1">Vendors</option>
                            <option value="2">Customers</option>
                            <option value="3">Subscribers</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <h6><strong>Email Subject*</strong></h6>
                    <div class="input-group">
                        <input type="text" name="subject" class="form-control" placeholder="Subject" aria-describedby="basic-addon1">
                    </div>
                </div>            
                <div class="form-group">
                    <h6><strong>Email Body*</strong></h6>
                    <div class="input-group">
                        <textarea name="body" class="summernote"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary theme-bg gradient">Send Email</button>
                </div>
            </form>
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

