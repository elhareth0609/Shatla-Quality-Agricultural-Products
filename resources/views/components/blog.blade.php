<div class="blog-card col-4">

  <a href="{{ route('blog.ones',$blog->id) }}" style="height: 180px">
    <img src="{{ $blog->photoUrl() }}" alt="{{ $blog->title }}" width="300" class="blog-banner" style="height: inherit;">
  </a>

  <div class="blog-content">
    <a href="{{ route('blog.ones',$blog->id) }}">
      <h3 class="blog-title">{{ \Illuminate\Support\Str::limit($blog->title, 79) }}</h3>
    </a>
    <div class="d-flex mb-4 align-items-center pb-2" dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}">
      <div class="flex-shrink-0 {{ app()->isLocale('ar') ? 'ms-3' : 'me-3' }} avatar">
        <a href="{{ route('expert.view',$blog->user->expert->id) }}"><img src="{{ $blog->user->expert->photoUrl() }}" class="img-fluid w-px-40 h-auto rounded-circle" alt="{{ $blog->user->expert->fullname }}"></a>
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
