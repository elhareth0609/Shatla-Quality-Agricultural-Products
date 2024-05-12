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
                <div class="d-flex mb-4 align-items-center pb-2">
                  <div class="flex-shrink-0 ms-2 avatar">
                    <a href="{{ route('expert.view',$blog->user->expert->id) }}"><img src="{{ $blog->user->expert->photoUrl() }}" class="img-fluid w-px-40 h-auto rounded-circle" alt="{{ $blog->user->expert->fullname }}"></a>
                  </div>
                  <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                    <div class="me-2">
                      <a href="{{ route('expert.view',$blog->user->expert->id) }}"><h6 class="mb-0">{{ $blog->user->expert->fullname }}</h6></a>
                      <small>{{ $blog->created_at->format('M d, Y') }}</small>
                    </div>
                      <a dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}" class="text-success mb-0">{{ $blog->view }} {{ __('view') }}</a>

                  </div>
                </div>

                <a class="badge bg-secondary text-decoration-none link-light text-white" href="{{ route('subcategory.view',$blog->subcategory->id) }}">{{ $blog->subcategory->getName() }}</a>
                {{-- <a class="badge bg-secondary text-decoration-none link-light" href="#!">Freebies</a> --}}
              </header>
              <figure class="mb-4">
                <img class="img-fluid rounded" src="{{ $blog->photoUrl() }}" alt="{{ $blog->title }}" style="width: 720px;height: 350px;"/>
              </figure>

              <section class="mb-5">
                {{ $blog->content }}
              </section>
          </article>

          <section class="mb-5">
              <div class="card bg-light">
                  <div class="card-body">
                      <form class="mb-4" id="addCommentForm" action="{{ route('blog.comment',$blog->id) }}" method="POST">
                        @csrf
                        <div class="input-group" dir="ltr">
                          <button type="submit" class="input-group-text">
                            <span class="mdi mdi-send-outline rotate-180"></span>
                          </button>
                          <input type="hidden" name="blog_id" value="{{ $blog->id }}" />
                          <textarea class="form-control text-right" name="content" dir="rtl" id="textarea" aria-label="With textarea" placeholder="{{ __('Comment...') }}"></textarea>
                        </div>
                      </form>

                      {{-- <div class="d-flex mb-4">
                          <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                          <div class="ms-3">
                              <div class="fw-bold">Commenter Name</div>
                              Comment 1
                              <div class="d-flex mt-4">
                                  <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                  <div class="ms-3">
                                      <div class="fw-bold">Commenter Name</div>
                                      Comments 1 1
                                  </div>
                              </div>
                              <div class="d-flex mt-4">
                                  <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                  <div class="ms-3">
                                      <div class="fw-bold">Commenter Name</div>
                                      Comment 1 2
                                  </div>
                              </div>
                          </div>
                      </div> --}}
                    <div id="comments">
                      @foreach ($blog->comments  as $comment)
                        <div class="d-flex mb-4">
                          <div class="flex-shrink-0 avatar ms-2">
                            <img class="rounded-circle" src="{{ $comment->profile->photoUrl() }}" alt="{{ $comment->profile->fullname }}" />
                          </div>
                          <div class="ms-3">
                            <div class="fw-bold">{{ $comment->profile->fullname }}</div>
                                {{ $comment->content }}
                          </div>
                        </div>
                      @endforeach
                    </div>
              </div>
          </section>
        </div>

      <div class="col-lg-4">
          <div class="card mb-4">
              <div class="card-header">{{ __('Tags') }}</div>
              <div class="card-body">
                <div class="row">
                  <ul class="list-unstyled mb-0" style="display: contents">
                      @foreach ($blog->StringToTags($blog->tags) as $tag)
                              <li><a class="btn rounded-pill btn-outline-secondary m-1" href="#!">{{ htmlspecialchars($tag['value']) }}</a></li>
                      @endforeach
                  </ul>
              </div>
            </div>
          </div>

          <div class="card mb-4">
              <div class="card-header">{{ __('Blogs') }}</div>
              <div class="card-body">You can put anything you want inside of these side widgets. They are easy to use, and feature the Bootstrap 5 card component!</div>
          </div>
      </div>
  </div>
</div>
<script>
  var lang = "{{ app()->getLocale() }}";
  function uploadComments(comment) {
    var commentHtml = `
        <div class="d-flex mb-4">
          <div class="flex-shrink-0 avatar ms-2">
            <img class="rounded-circle" src="${comment.photo}" alt="${comment.fullname}" />
          </div>
          <div class="ms-3">
            <div class="fw-bold">${comment.fullname}</div>
            ${comment.content}
          </div>
        </div>
      `;
      $('#comments').append(commentHtml);
  }
  $(document).ready(function() {

    $('#addCommentForm').submit(function(event) {
        event.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
          url: $(this).attr('action'),
          type: $(this).attr('method'),
          data: formData,
          dataType: 'json',
          success: function(response) {
            Swal.fire({
              icon: response.icon,
              title: response.state,
              text: response.message,
              confirmButtonText: __("Ok",lang)
            });
            uploadComments(response.comment);
            $('#textarea').val('');
          },
          error: function(xhr, textStatus, errorThrown) {
            const response = JSON.parse(xhr.responseText);
            Swal.fire({
              icon: response.icon,
              title: response.state,
              text: response.message,
              confirmButtonText: __("Ok",lang)
            });
          }
        });
    });
  });
</script>
@else
<x-placeholder></x-placeholder>
@endif
@endsection
