<div class="col-sm-6 col-md-4 col-lg-4 mb-3" data-item-id="{{ $article->id }}">
  <div class="blog-card bg-white rounded p-2">

    <a href="http://127.0.0.1:8000/view/blogs/28" class="mb-4 rounded h-px-185 d-flex justify-content-center position-relative" style="height: 180px">
      <div style="background: rgba(0, 0, 0, 0.5);backdrop-filter: blur(10px);" class="position-absolute w-100 h-100 rounded"></div>
      <img class="img-fluid position-absolute h-100 rounded-0" src="{{ $article->photoUrl() }}" alt="{{ $article->title }}">
      <img class="img-fluid w-100 h-100 rounded" src="{{ $article->photoUrl() }}" alt="{{ $article->title }}">
    </a>

    <div class="blog-content">
      <a href="{{ route('article.ones',$article->id) }}">
        <h3 class="blog-title">{{ \Illuminate\Support\Str::limit($article->title, 79) }}</h3>
      </a>
      <div class="d-flex mb-2 align-items-center justify-content-between" dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}">
          <div class="d-flex">
            <a href="{{ route('subcategory.view',$article->id) }}" class="badge bg-label-primary mb-0 mx-1">{{ $article->type->getName() }}</a>
            <a href="{{ route('subcategory.view',$article->id) }}" class="badge bg-label-primary mb-0 mx-1">{{ $article->disease->getName() }}</a>
          </div>
          <small>{{ $article->created_at->format('M d, Y') }}</small>
      </div>
    </div>

  </div>
</div>
