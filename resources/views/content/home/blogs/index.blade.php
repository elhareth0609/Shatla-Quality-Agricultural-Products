@extends('layouts.homeLayout')

@section('title', __('Blogs'))

@section('content')

<div class="blog">

  <div class="container">

    <div class="row">

      @foreach($blogs as $blog)

      <div class="blog-card col-3">

        <a href="{{ route('blog.ones',$blog->id) }}">
          <img src="{{ $blog->photoUrl() }}" alt="{{ $blog->title }}" width="300" class="blog-banner">
        </a>

        <div class="blog-content">

          <a href="{{ route('subcategory.view',$blog->subcategory->id) }}" class="blog-category">{{ $blog->subcategory->getName() }}</a>

          <a href="{{ route('blog.ones',$blog->id) }}">
            <h3 class="blog-title">{{ $blog->title }}</h3>
          </a>

          <p class="blog-meta">
            {{ __('By') }} <cite>{{ $blog->user->experts->fullname }}</cite> / <time datetime="{{ $blog->created_at }}">{{ $blog->created_at->format('M d, Y') }}</time>
          </p>

        </div>

      </div>

      @endforeach

    </div>

  </div>

</div>

@endsection
