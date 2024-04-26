@extends('layouts.homeLayout')

@section('title', __('Publications'))

@section('content')

<div class="blog">

  <div class="container">

    <div class="row">

      @foreach($publications as $publication)

      <div class="blog-card col-3">

        <a href="{{ route('publication.ones',$publication->id) }}">
          <img src="{{ $publication->photoUrl() }}" alt="{{ $publication->title }}" width="300" class="blog-banner">
        </a>

        <div class="blog-content">

          <a href="{{ route('publication.ones',$publication->id) }}">
            <h3 class="blog-title">{{ $publication->title }}</h3>
          </a>

          <p class="blog-meta">
            {{ __('By') }} <cite>{{ $publication->user->worker->fullname }}</cite> / <time datetime="{{ $publication->created_at }}">{{ $publication->created_at->format('M d, Y') }}</time>
          </p>

        </div>

      </div>

      @endforeach

    </div>

  </div>

</div>

@endsection
