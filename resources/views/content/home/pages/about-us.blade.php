@extends('layouts.homeLayout')

@section('title', __('About Us'))

@section('content')
<div class="container my-5">
  <div class="row justify-content-center mb-5">
    <div class="col-md-8 text-center my-w-fit-content">
      <h1 class="mb-4">{{ __('About Us') }}</h1>
      <div class="border-bottom border-dark"></div>
    </div>
  </div>
{!! $content !!}
</div>
@endsection
