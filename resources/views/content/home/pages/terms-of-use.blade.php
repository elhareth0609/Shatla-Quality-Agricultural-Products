@extends('layouts.homeLayout')

@section('title', __('Terms Of Use'))

@section('content')
<div class="container my-5">
  <div class="row justify-content-center mb-5">
    <div class="col-md-8 text-center my-w-fit-content">
      <h1 class="mb-4">{{ __('Terms Of Use') }}</h1>
      <div class="border-bottom border-dark"></div>
    </div>
  </div>
  {!! $content !!}
</div>
@endsection
