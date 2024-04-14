{{-- @extends('content.home.app') --}}
@extends('layouts.homeLayout')

@section('title', '')

@section('content')
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-8 text-center my-w-fit-content">
      <h1 class="mb-4">{{ __('Plans') }}</h1>
      <div class="border-bottom border-dark"></div>
    </div>
  </div>

  <div class="my-5">
    @foreach ($plans->chunk(2) as $chunk)
      <div class="row ">
        @foreach ($chunk as $plan)
          <div class="col-md-6"> <!-- Each plan takes half of the row -->
            <div class="card mb-3">
              <div class="row g-0">
                <div class="col-md-4">
                  <img class="card-img card-img-left" src="{{ asset('assets/img/elements/12.jpg') }}" alt="Card image" />
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <h5 class="card-title">{{ $plan->name }}</h5>
                    <p class="card-text">{{ $plan->text }}</p>
                    <p class="card-text"><small class="text-muted">{{ $plan->price }}   {{ $plan->last_price }}</small></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @endforeach
  </div>

{{-- <div class="col-md">
  <div class="card mb-3">
    <div class="row g-0">
      <div class="col-md-4">
        <img class="card-img card-img-left" src="{{asset('assets/img/elements/12.jpg')}}" alt="Card image" />
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">
            This is a wider card with supporting text below as a natural lead-in to additional content. This content
            is a
            little bit longer.
          </p>
          <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="col-md">
  <div class="card mb-3">
    <div class="row g-0">
      <div class="col-md-8">
        <div class="card-body">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">
            This is a wider card with supporting text below as a natural lead-in to additional content. This content
            is a
            little bit longer.
          </p>
          <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
        </div>
      </div>
      <div class="col-md-4">
        <img class="card-img card-img-right" src="{{asset('assets/img/elements/17.jpg')}}" alt="Card image" />
      </div>
    </div>
  </div>
</div> --}}




</div>
@endsection
