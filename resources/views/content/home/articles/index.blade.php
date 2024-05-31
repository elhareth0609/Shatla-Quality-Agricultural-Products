@extends('layouts.homeLayout')

@section('title', __('Articles'))

@section('content')

<div class="blog" dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}">

  <div class="container">
    <h2 class="title">{{ __('Articles') }}</h2>
    <div class="row">

      @foreach($articles as $article)
        <x-article :article="$article" />
      @endforeach

    </div>
  </div>

</div>

@endsection
