@extends('layouts.homeLayout')

@section('title', '')

@section('content')
@if ($blog)
<div class="container mt-5" dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}">
  <div class="row">
      <div class="col-lg-8">
          <article>
            <header class="mb-4">
                <h1 class="fw-bolder mb-1">{{ $blog->title }}</h1>
                <div class="text-muted fst-italic mb-2">{{ __('Posted on') }} {{ $blog->created_at }} {{ __('by') }}
                  <a href="{{ route('expert.view',$blog->user->expert->id) }}">{{ $blog->user->expert->fullname }}</a>
                </div>
                {{-- view --}}

                <a class="badge bg-secondary text-decoration-none link-light" href="{{ route('subcategory.view',$blog->subcategory->id) }}">{{ $blog->subcategory->getName() }}</a>
                {{-- <a class="badge bg-secondary text-decoration-none link-light" href="#!">Freebies</a> --}}
              </header>
              <figure class="mb-4"><img class="img-fluid rounded" src="{{ $blog->photoUrl() }}" alt="{{ $blog->title }}" /></figure>

              <section class="mb-5">
                {{ $blog->content }}
              </section>
          </article>

          <section class="mb-5">
              <div class="card bg-light">
                  <div class="card-body">
                      <form class="mb-4"><textarea class="form-control" rows="3" placeholder="Join the discussion and leave a comment!"></textarea></form>
                      <div class="d-flex mb-4">
                          <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                          <div class="ms-3">
                              <div class="fw-bold">Commenter Name</div>
                              If you're going to lead a space frontier, it has to be government; it'll never be private enterprise. Because the space frontier is dangerous, and it's expensive, and it has unquantified risks.
                              <div class="d-flex mt-4">
                                  <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                  <div class="ms-3">
                                      <div class="fw-bold">Commenter Name</div>
                                      And under those conditions, you cannot establish a capital-market evaluation of that enterprise. You can't get investors.
                                  </div>
                              </div>
                              <div class="d-flex mt-4">
                                  <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                  <div class="ms-3">
                                      <div class="fw-bold">Commenter Name</div>
                                      When you put money directly to a problem, it makes a good headline.
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="d-flex">
                          <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                          <div class="ms-3">
                              <div class="fw-bold">Commenter Name</div>
                              When I look at the universe and all the ways the universe wants to kill us, I find it hard to reconcile that with statements of beneficence.
                          </div>
                      </div>
                  </div>
              </div>
          </section>
      </div>

      <div class="col-lg-4">
          <div class="card mb-4">
              <div class="card-header">Categories</div>
              <div class="card-body">
                  <div class="row">
                      <div class="col-sm-6">
                          <ul class="list-unstyled mb-0">
                              <li><a href="#!">Web Design</a></li>
                              <li><a href="#!">HTML</a></li>
                              <li><a href="#!">Freebies</a></li>
                          </ul>
                      </div>
                      <div class="col-sm-6">
                          <ul class="list-unstyled mb-0">
                              <li><a href="#!">JavaScript</a></li>
                              <li><a href="#!">CSS</a></li>
                              <li><a href="#!">Tutorials</a></li>
                          </ul>
                      </div>
                  </div>
              </div>
          </div>

          <div class="card mb-4">
              <div class="card-header">Side Widget</div>
              <div class="card-body">You can put anything you want inside of these side widgets. They are easy to use, and feature the Bootstrap 5 card component!</div>
          </div>
      </div>
  </div>
</div>
@else
<x-placeholder></x-placeholder>
@endif
@endsection
