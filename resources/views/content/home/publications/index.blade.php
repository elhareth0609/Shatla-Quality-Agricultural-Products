@extends('layouts.homeLayout')

@section('title', __('Publications'))

@section('content')

<div class="blog">
  <div class="container">
    <div class="row">

      @foreach($publications as $publication)
        <x-publication :blog="$publication" />
      @endforeach

    </div>
  </div>
</div>

@endsection
