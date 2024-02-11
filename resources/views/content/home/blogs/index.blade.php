@extends('content.home.app')

@section('title', 'Blogs')

@section('content')

<div class="blog">

  <div class="container">

    <div class="blog-container has-scrollbar">

      @foreach($blogs as $blog)

      <div class="blog-card">

        <a href="#">
          <img src="{{ asset('assets/home/images/' . $blog->image) }}" alt="{{ $blog->title }}" width="300" class="blog-banner">
        </a>

        <div class="blog-content">

          <a href="#" class="blog-category">{{ $blog->category }}</a>

          <a href="#">
            <h3 class="blog-title">{{ $blog->title }}</h3>
          </a>

          <p class="blog-meta">
            By <cite>{{ $blog->author }}</cite> / <time datetime="{{ $blog->created_at }}">{{ $blog->created_at->format('M d, Y') }}</time>
          </p>

        </div>

      </div>

      @endforeach

    </div>

  </div>

</div>

@endsection
