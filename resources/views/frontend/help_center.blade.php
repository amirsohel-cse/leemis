@extends('frontend.master.help_master')

@section('content')
<section class="section-padding">
    <div class="container custom-container">
        <div class="row mb-none-30">
            <div class="col-lg-12">
                <h2 class="mb-4" style="color: #404553">Browse Topics</h2>
            </div>
            @foreach ($categories as $category)
            <div class="col-lg-6 mb-30">
                <div class="faq-box">
                    <a href="{{route('help.articles', $category->id)}}" class="faq-box-link"></a>
                    <div class="icon">
                        <img src="{{ asset('topic.png') }}" alt="image">
                    </div>
                    <div class="content">
                        <h3 class="title">{{$category->name}}</h3>
                        <span>{{$category->articals->count()}} articles</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section> 
@endsection