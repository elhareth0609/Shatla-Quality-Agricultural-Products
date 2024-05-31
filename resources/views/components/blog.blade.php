<div class="col-sm-6 col-md-4 col-lg-4 mb-3" data-item-id="{{ $blog->id }}">
  <div class="blog-card bg-white rounded p-2">

    {{-- <a href="{{ route('blog.ones',$blog->id) }}" class="d-flex justify-content-center bg-black rounded" style="height: 180px">
      <img src="{{ $blog->photoUrl() }}" alt="{{ $blog->title }}" class="img-fluid">
    </a> --}}
    <a href="http://127.0.0.1:8000/view/blogs/28" class="mb-4 rounded h-px-185 d-flex justify-content-center position-relative" style="height: 180px">
      <div style="background: rgba(0, 0, 0, 0.5);backdrop-filter: blur(10px);" class="position-absolute w-100 h-100 rounded"></div>
      <img class="img-fluid position-absolute h-100 rounded-0" src="{{ $blog->photoUrl() }}" alt="{{ $blog->title }}">
      <img class="img-fluid w-100 h-100 rounded" src="{{ $blog->photoUrl() }}" alt="{{ $blog->title }}">
    </a>

    <div class="blog-content">
      <a href="{{ route('blog.ones',$blog->id) }}">
        <h3 class="blog-title">{{ \Illuminate\Support\Str::limit($blog->title, 79) }}</h3>
      </a>
      <div class="d-flex mb-2 align-items-center" dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}">
        <div class="flex-shrink-0 {{ app()->isLocale('ar') ? 'ms-3' : 'me-3' }} avatar">
          <a href="{{ route('expert.view',$blog->user->expert->id) }}">
            <img src="{{ $blog->user->expert->photoUrl() }}" class="img-fluid w-px-40 h-auto rounded-circle" alt="{{ $blog->user->expert->fullname }}">
          </a>
        </div>
        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
          <div class="me-2">
            <a href="{{ route('expert.view',$blog->user->expert->id) }}">
              <h6 class="mb-0">{{ $blog->user->expert->fullname }}</h6>
            </a>
            <small>{{ $blog->created_at->format('M d, Y') }}</small>
          </div>
            <a href="{{ route('subcategory.view',$blog->subcategory->id) }}" class="badge bg-label-primary mb-0">{{ $blog->subcategory->getName() }}</a>
        </div>
      </div>
    </div>

  </div>
</div>
