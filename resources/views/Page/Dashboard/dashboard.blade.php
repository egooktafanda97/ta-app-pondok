@extends('template.layout')
@section('content')

<div class="container">
    <div class="row  mb-4">
        <div class="col-sm">
            <img src="{{ asset('landing-page') }}/img/1.jpg" class="img-fluid rounded" alt="...">        </div>
        <div class="col-sm">
            <img  src="{{ asset('landing-page') }}/img/2.jpg" class="img-fluid rounded" alt="...">        </div>     
    </div>
    <div class="row mb-4">
        <div class="col-sm">
            <img src="{{ asset('landing-page') }}/img/3.jpg" class="img-fluid rounded" alt="...">        </div>
        <div class="col-sm">
            <img  src="{{ asset('landing-page') }}/img/4.jpg" class="img-fluid rounded" alt="...">        </div>     
    </div>
    <div class="row mb-4">
        <div class="col-sm">
            <img src="{{ asset('landing-page') }}/img/5.jpg" class="img-fluid rounded" alt="...">        </div>
        <div class="col-sm">
            <img  src="{{ asset('landing-page') }}/img/6.jpg" class="img-fluid rounded" alt="...">        </div>     
    </div>
</div>
@endsection
