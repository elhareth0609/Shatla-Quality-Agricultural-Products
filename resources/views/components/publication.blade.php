{{-- <div id="carouselExampleDark{{ $publication->id }}" class="carousel carousel-dark slide carousel-fade col-md-4 mb-2 rounded" data-bs-ride="carousel" style="height: 400px">
  <div class="carousel-indicators">
    @foreach ($publication->photos as $key => $photo)
      <button type="button" data-bs-target="#carouselExampleDark{{ $publication->id }}" data-bs-slide-to="{{ $key }}" {{ $key == 0 ? ' class=active aria-current=true  ' : '' }} aria-label="Slide {{ $key }}"></button>
    @endforeach
  </div>
  <div class="carousel-inner h-100 rounded">
    @foreach ($publication->photos as $key => $photo)
      <div class="carousel-item justify-content-center bg-black d-flex h-100 {{ $key == 0 ? 'active' : '' }}">
        <img class="img-fluid" src="{{ $photo->photoUrl() }}" alt="{{ $photo->id }}" />
        <div class="carousel-caption d-none d-md-block rounded" style="background : rgba(0, 0, 0, 0.5)">
          <h4 class="text-white">
            <a href="{{ route('publication.ones',$publication->id) }}" class="text-white" style="text-decoration: none;">
              {{ \Illuminate\Support\Str::limit(strip_tags($publication->title), 79) }}
            </a>
          </h4>
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
</div> --}}


<div id="carouselExampleDark{{ $publication->id }}" class="carousel carousel-dark slide carousel-fade col-md-4 mb-2 rounded" data-bs-ride="carousel" style="height: 400px">
  <div class="carousel-indicators">
    @foreach ($publication->photos as $key => $photo)
      <button type="button" data-bs-target="#carouselExampleDark{{ $publication->id }}" data-bs-slide-to="{{ $key }}" {{ $key == 0 ? ' class=active aria-current=true  ' : '' }} aria-label="Slide {{ $key }}"></button>
    @endforeach
  </div>
  <div class="carousel-inner h-100 rounded">
    @foreach ($publication->photos as $key => $photo)
    <div class="carousel-item justify-content-center bg-black d-flex h-100 position-relative {{ $key == 0 ? 'active' : '' }}">
      <img class="img-fluid" src="{{ $photo->photoUrl() }}" alt="{{ $photo->id }}" />
      <div class="like-dislike-icons position-absolute top-50 start-50 translate-middle" style="display: none;">
        <button type="button" class="btn btn-xl mx-3 btn-icon btn-transparent">
          <span class="mdi mdi-arrow-up-bold-circle-outline text-success mx-2"></span>
        </button>
        <button type="button" class="btn btn-xl mx-3 btn-icon btn-transparent">
          <span class="mdi mdi-arrow-down-bold-circle-outline text-danger mx-2"></span>
        </button>
      </div>
      <div class="carousel-caption d-none d-md-block rounded" style="background : rgba(0, 0, 0, 0.5)">
          <h4 class="text-white">
            <a href="{{ route('publication.ones',$publication->id) }}" class="text-white" style="text-decoration: none;">
              {{ \Illuminate\Support\Str::limit(strip_tags($publication->title), 79) }}
            </a>
          </h4>
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
