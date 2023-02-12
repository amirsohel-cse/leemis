@extends('frontend.master.master')
@section('content')

<div class="page-wrapper">
    <main class="main">
      <div class="container">

          <div class="card">
              <div class="card-header">
              </div>
              <div class="card-body">
                  <h2 class="card-title text-center"> <strong><h2 class="text-uppercase">{{$blog->title}}</h2></strong> </h2>
                  <div class="container">                      
                      <p>{!!$blog->details!!}</p>
                  </div>
              </div>
          </div>

      </div>

    </main>



@endsection
