@extends('layouts.homeLayout')

@section('title', __('Blogs'))

@section('content')

<div class="blog">

  <div class="container">
    <div class="row">

      @foreach($blogs as $blog)
        <x-blog :blog="$blog" />
      @endforeach

    </div>
  </div>

</div>

@endsection
