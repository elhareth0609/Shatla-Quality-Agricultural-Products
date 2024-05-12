@extends('layouts.homeLayout')

@section('title', __('Publications'))

@section('content')

<div class="blog" dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}">
  <div class="container">
    <h2 class="title">{{ __('Agricultural Services') }}</h2>
    <div class="row">

      @foreach($publications as $publication)
        <x-publication :publication="$publication" />
      @endforeach

    </div>
  </div>
</div>

@endsection
