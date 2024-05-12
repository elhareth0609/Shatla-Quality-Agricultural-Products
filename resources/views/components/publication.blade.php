{{-- <div class="blog-card col-3">

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

</div> --}}


<div id="carouselExampleDark{{ $publication->id }}" class="carousel carousel-dark slide carousel-fade col-md-4 mb-2 rounded" data-bs-ride="carousel">
  <div class="carousel-indicators">
    @foreach ($publication->photos as $key => $photo)
      <button type="button" data-bs-target="#carouselExampleDark{{ $publication->id }}" data-bs-slide-to="{{ $key }}" {{ $key == 0 ? ' class=active aria-current=true  ' : '' }} aria-label="Slide {{ $key }}"></button>
    @endforeach
  </div>
  <div class="carousel-inner">
    @foreach ($publication->photos as $key => $photo)
      <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
        <img class="d-block w-100 rounded" src="{{ $photo->photoUrl() }}" alt="{{ $photo->id }}" />
        <div class="carousel-caption d-none d-md-block">
          <h3>{{ $photo->title }}</h3>
          <p>{{ $photo->content }}</p>
        </div>
      </div>
    @endforeach
  </div>
  <a class="carousel-control-prev" href="#carouselExampleDark{{ $publication->id }}" role="button" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">{{ __('Previous') }}</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleDark{{ $publication->id }}" role="button" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">{{ __('Next') }}</span>
  </a>
</div>
