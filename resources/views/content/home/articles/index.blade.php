@extends('layouts.homeLayout')

@section('title', __('Blogs'))

@section('content')

<div class="blog" dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}">

  <div class="container">
    <h2 class="title">{{ __('Blogs') }}</h2>
    <div class="row">

      @foreach($blogs as $blog)
        <x-blog :blog="$blog" />
      @endforeach

    </div>
  </div>

</div>

@endsection
