@extends('layouts.homeLayout')

@section('title', '')

@section('content')
@if ($product)

    <!-- Shop Detail Start -->
    <div class="container-fluid py-5" dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}">
      <div class="row px-xl-5">
          <div class="col-lg-5 pb-5">

              <div id="carouselExample" class="carousel carousel-dark slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                  @foreach ($product->photos as $index => $photo)
                    @if ($photo->type === '1')
                      <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="{{ $index }}" class="active" aria-current="true" aria-label="Slide {{ $index }}"></button>
                    @else
                      <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="{{ $index }}" aria-label="Slide {{ $index }}"></button>
                    @endif
                  @endforeach
                </div>
                <div class="carousel-inner rounded">
                  @foreach ($product->photos as $photo)
                    @if ($photo->typeof === '0')
                      @if ($photo->type === '1')
                        <div class="carousel-item active">
                          <img class="d-block" src="{{ $photo->photoUrl() }}" width="300" height="300" alt="First slide" />
                        </div>
                      @else
                        <div class="carousel-item">
                          <img class="d-block" src="{{ $photo->photoUrl() }}" width="300" height="300" alt="First slide" />
                        </div>
                      @endif
                    @endif
                  @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExample" role="button" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">{{ __('Previous') }}</span>
                </a>
                <a class="carousel-control-next" href="#carouselExample" role="button" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">{{ __('Next') }}</span>
                </a>
              </div>


          </div>
          <div class="col-lg-7 pb-5">
              <h3 class="font-weight-semi-bold">{{ $product->name }}</h3>
              <div class="d-flex mb-3">
                  <div class="text-primary mr-2">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= $product->comments->sum('stars'))
                        <small class="mdi mdi-star"></small>
                        @else
                        <small class="mdi mdi-star-outline"></small>
                        @endif
                    @endfor

                      {{-- <small class="mdi mdi-star-outline"></small>
                      <small class="mdi mdi-star-outline"></small>
                      <small class="mdi mdi-star-outline"></small>
                      <small class="mdi mdi-star-outline"></small>
                      <small class="mdi mdi-star-outline"></small> --}}
                  </div>
                  <small class="pt-1 me-1">({{ $product->view }} {{ __('Reviews') }})</small>
              </div>
              <h3 class="font-weight-semi-bold mb-4">{{ $product->price }} د.ج</h3>
              <p class="mb-4">{!! $product->description !!}</p>





              {{-- <div class="row">
                <div class="col-6">
                  <div class="input-group input-group-merge" dir="{{ app()->isLocale('ar') ? 'ltr' : '' }}">
                    <span class="input-group-text">{{ __('Quantity') }}</span>
                    <input type="number" class="form-control" placeholder="0" value="1" aria-label="Amount (to the nearest dollar)" max="{{ $product->quantity }}" min="1" name="productQuantity"/>
                    <input type="hidden" value="{{ $product->id }}" name="id"/>
                  </div>
                </div>
                <div class="col-6">
                  <div class="input-group input-group-merge" >
                    <button type="button" class="btn btn-outline-primary" id="add-cart-btn">
                      <span class="tf-icons mdi mdi-cart-check mx-1"></span>{{ __('Add To Cart') }}
                    </button>
                  </div>
                </div>
              </div> --}}

              <input type="hidden" value="{{ $product->id }}" name="id"/>
              <div class="row d-flex justify-content-between">
                <div class="my-w-fit-content d-flex">
                  <div class="my-w-fit-content mx-1">
                      <div class="btn-group" role="group" aria-label="Second group" dir="ltr">
                        <button type="button" class="btn btn-icon btn-primary btn-plus-product">
                          <span class="tf-icons mdi mdi-plus"></span>
                      </button>
                      <input type="text" class="form-control text-center p-0 rounded-0 my-w-5 input-price-product" value="1" max="{{ $product->quantity }}" min="1" name="productQuantity">
                      <button type="button" class="btn btn-icon btn-primary btn-minus-product">
                        <span class="tf-icons mdi mdi-minus"></span>
                      </button>
                    </div>
                  </div>
                  <div class="my-w-fit-content mx-1">
                    <div class="input-group input-group-merge">
                      <button type="button" class="btn btn-outline-primary" id="add-cart-btn">
                        <span class="tf-icons mdi mdi-cart-check mx-1"></span>{{ __('Add To Cart') }}
                      </button>
                    </div>
                  </div>
                </div>
                <div class="my-w-fit-content">
                <button type="button" class="btn btn-icon btn-outline-primary mx-1" id="add-cart-btn">
                        <span class="tf-icons mdi mdi-share-outline mx-1"></span>
                </button>
                <button type="button" class="btn btn-icon btn-outline-primary mx-1" id="add-cart-btn">
                        <span class="tf-icons mdi mdi-heart-outline mx-1"></span>
                </button>
                </div>
              </div>




              {{-- <div class="d-flex pt-2">
                  <p class="text-dark font-weight-medium mb-0 mr-2">Share on:</p>
                  <div class="d-inline-flex">
                      <a class="text-dark px-2" href="#">
                        <ion-icon name="logo-facebook"></ion-icon>
                      </a>
                      <a class="text-dark px-2" href="#">
                        <ion-icon name="logo-twitter"></ion-icon>
                      </a>
                      <a class="text-dark px-2" href="#">
                        <ion-icon name="logo-instagram"></ion-icon>
                      </a>
                      <a class="text-dark px-2" href="#">
                        <ion-icon name="logo-pinterest"></ion-icon>
                      </a>
                  </div>
              </div> --}}
          </div>
      </div>
      <div class="row px-xl-5">
          <div class="col">


            <div class="nav-align-top mb-4">
              <ul class="nav nav-tabs nav-fill" role="tablist">
                <li class="nav-item">
                  <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-home" aria-controls="navs-justified-home" aria-selected="true"><i class="tf-icons mdi mdi-newspaper mx-1"></i><span class="d-none d-sm-block">{{ __('Content') }}</span></button>
                </li>
                <li class="nav-item">
                  <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-profile" aria-controls="navs-justified-profile" aria-selected="false"><i class="tf-icons mdi mdi-account-outline mx-1"></i><span class="d-none d-sm-block">{{ __('Profile') }}</span></button>
                </li>
                <li class="nav-item">
                  <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-messages" aria-controls="navs-justified-messages" aria-selected="false"><i class="tf-icons mdi mdi-message-text-outline mx-1"></i><span class="d-none d-sm-block">{{ __('Comments') }}</span><span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-label-danger mx-1">{{ $product->comments->count() }}</span></button>
                </li>
              </ul>
            </div>
          </div>
          <div class="card-body">
            <div class="tab-content p-0">
              <div class="tab-pane fade show active" id="navs-justified-home" role="tabpanel">
                  <h4 class="mb-3">{{ __('Product Description') }}</h4>
                  {!! $product->content !!}
                </div>
                <div class="tab-pane fade" id="navs-justified-profile" role="tabpanel">
                  <h4 class="mb-3">Additional Information</h4>
                  <p>Eos no lorem eirmod diam diam, eos elitr et gubergren diam sea. Consetetur vero aliquyam invidunt duo dolores et duo sit. Vero diam ea vero et dolore rebum, dolor rebum eirmod consetetur invidunt sed sed et, lorem duo et eos elitr, sadipscing kasd ipsum rebum diam. Dolore diam stet rebum sed tempor kasd eirmod. Takimata kasd ipsum accusam sadipscing, eos dolores sit no ut diam consetetur duo justo est, sit sanctus diam tempor aliquyam eirmod nonumy rebum dolor accusam, ipsum kasd eos consetetur at sit rebum, diam kasd invidunt tempor lorem, ipsum lorem elitr sanctus eirmod takimata dolor ea invidunt.</p>
                  <div class="row">
                      <div class="col-md-6">
                          <ul class="list-group list-group-flush">
                              <li class="list-group-item px-0">
                                  Sit erat duo lorem duo ea consetetur, et eirmod takimata.
                              </li>
                              <li class="list-group-item px-0">
                                  Amet kasd gubergren sit sanctus et lorem eos sadipscing at.
                              </li>
                              <li class="list-group-item px-0">
                                  Duo amet accusam eirmod nonumy stet et et stet eirmod.
                              </li>
                              <li class="list-group-item px-0">
                                  Takimata ea clita labore amet ipsum erat justo voluptua. Nonumy.
                              </li>
                            </ul>
                      </div>
                      <div class="col-md-6">
                          <ul class="list-group list-group-flush">
                              <li class="list-group-item px-0">
                                  Sit erat duo lorem duo ea consetetur, et eirmod takimata.
                              </li>
                              <li class="list-group-item px-0">
                                  Amet kasd gubergren sit sanctus et lorem eos sadipscing at.
                              </li>
                              <li class="list-group-item px-0">
                                  Duo amet accusam eirmod nonumy stet et et stet eirmod.
                              </li>
                              <li class="list-group-item px-0">
                                  Takimata ea clita labore amet ipsum erat justo voluptua. Nonumy.
                              </li>
                            </ul>
                      </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="navs-justified-messages" role="tabpanel">
                  <div class="row">
                    <div class="col-md-6">
                        <h4 class="mb-4">{{ $product->comments->count() }} {{ __('comment for') }} "{{ $product->name }}"</h4>
                        @foreach ($product->comments as $comment)
                        <div class="media mb-4">
                          <div class="row">
                            <img src="{{ $comment->user->photoUrl() }}" alt="Image" class="img-fluid mr-3 rounded-circle my-2" style="width: 60px;">
                            <div class="showcase-rating d-flex my-w-fit-content my-h-fit-content mx-0 my-auto">
                              @for ($i = 1; $i <= 5; $i++)
                                  @if ($i <= $comment->stars)
                                      <ion-icon name="star" role="img" class="md hydrated" aria-label="star"></ion-icon>
                                  @else
                                      <ion-icon name="star-outline" role="img" class="md hydrated" aria-label="star outline"></ion-icon>
                                  @endif
                              @endfor
                            </div>
                          </div>

                            <div class="media-body">
                                <h6>{{ $comment->user->fullname }}<small> - <i>{{ $comment->updated_at }}</i></small></h6>
                                <p>{{ $comment->content }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @auth
                      <div class="col-md-6">
                          <h4 class="mb-4">{{ __('Leave a Comment') }}</h4>
                            <div class="d-flex my-3">
                                  <p class="mb-0 mr-2">{{ __('Your Rating * :') }}</p>
                                  {{-- <div class="text-primary">
                                      <i class="far fa-star"></i>
                                      <i class="far fa-star"></i>
                                      <i class="far fa-star"></i>
                                      <i class="far fa-star"></i>
                                      <i class="far fa-star"></i>
                                  </div> --}}
                            </div>
                              <form method="POST" id="addCommentForm" action="{{ route('product.comment') }}">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}" />
                                <div class="rating">
                                  <div class="rating__stars">
                                    <input id="rating-1" class="rating__input rating__input-1" type="radio" name="rating" value="1">
                                    <input id="rating-2" class="rating__input rating__input-2" type="radio" name="rating" value="2">
                                    <input id="rating-3" class="rating__input rating__input-3" type="radio" name="rating" value="3">
                                    <input id="rating-4" class="rating__input rating__input-4" type="radio" name="rating" value="4">
                                    <input id="rating-5" class="rating__input rating__input-5" type="radio" name="rating" value="5">
                                    <label class="rating__label" for="rating-1">
                                      <svg class="rating__star" width="32" height="32" viewBox="0 0 32 32" aria-hidden="true">
                                        <g transform="translate(16,16)">
                                          <circle class="rating__star-ring" fill="none" stroke="#000" stroke-width="16" r="8" transform="scale(0)" />
                                        </g>
                                        <g stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                          <g transform="translate(16,16) rotate(180)">
                                            <polygon class="rating__star-stroke" points="0,15 4.41,6.07 14.27,4.64 7.13,-2.32 8.82,-12.14 0,-7.5 -8.82,-12.14 -7.13,-2.32 -14.27,4.64 -4.41,6.07" fill="none" />
                                            <polygon class="rating__star-fill" points="0,15 4.41,6.07 14.27,4.64 7.13,-2.32 8.82,-12.14 0,-7.5 -8.82,-12.14 -7.13,-2.32 -14.27,4.64 -4.41,6.07" fill="#000" />
                                          </g>
                                          <g transform="translate(16,16)" stroke-dasharray="12 12" stroke-dashoffset="12">
                                            <polyline class="rating__star-line" transform="rotate(0)" points="0 4,0 16" />
                                            <polyline class="rating__star-line" transform="rotate(72)" points="0 4,0 16" />
                                            <polyline class="rating__star-line" transform="rotate(144)" points="0 4,0 16" />
                                            <polyline class="rating__star-line" transform="rotate(216)" points="0 4,0 16" />
                                            <polyline class="rating__star-line" transform="rotate(288)" points="0 4,0 16" />
                                          </g>
                                        </g>
                                      </svg>
                                      <span class="rating__sr">1 star—Terrible</span>
                                    </label>
                                    <label class="rating__label" for="rating-2">
                                      <svg class="rating__star" width="32" height="32" viewBox="0 0 32 32" aria-hidden="true">
                                        <g transform="translate(16,16)">
                                          <circle class="rating__star-ring" fill="none" stroke="#000" stroke-width="16" r="8" transform="scale(0)" />
                                        </g>
                                        <g stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                          <g transform="translate(16,16) rotate(180)">
                                            <polygon class="rating__star-stroke" points="0,15 4.41,6.07 14.27,4.64 7.13,-2.32 8.82,-12.14 0,-7.5 -8.82,-12.14 -7.13,-2.32 -14.27,4.64 -4.41,6.07" fill="none" />
                                            <polygon class="rating__star-fill" points="0,15 4.41,6.07 14.27,4.64 7.13,-2.32 8.82,-12.14 0,-7.5 -8.82,-12.14 -7.13,-2.32 -14.27,4.64 -4.41,6.07" fill="#000" />
                                          </g>
                                          <g transform="translate(16,16)" stroke-dasharray="12 12" stroke-dashoffset="12">
                                            <polyline class="rating__star-line" transform="rotate(0)" points="0 4,0 16" />
                                            <polyline class="rating__star-line" transform="rotate(72)" points="0 4,0 16" />
                                            <polyline class="rating__star-line" transform="rotate(144)" points="0 4,0 16" />
                                            <polyline class="rating__star-line" transform="rotate(216)" points="0 4,0 16" />
                                            <polyline class="rating__star-line" transform="rotate(288)" points="0 4,0 16" />
                                          </g>
                                        </g>
                                      </svg>
                                      <span class="rating__sr">2 stars—Bad</span>
                                    </label>
                                    <label class="rating__label" for="rating-3">
                                      <svg class="rating__star" width="32" height="32" viewBox="0 0 32 32" aria-hidden="true">
                                        <g transform="translate(16,16)">
                                          <circle class="rating__star-ring" fill="none" stroke="#000" stroke-width="16" r="8" transform="scale(0)" />
                                        </g>
                                        <g stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                          <g transform="translate(16,16) rotate(180)">
                                            <polygon class="rating__star-stroke" points="0,15 4.41,6.07 14.27,4.64 7.13,-2.32 8.82,-12.14 0,-7.5 -8.82,-12.14 -7.13,-2.32 -14.27,4.64 -4.41,6.07" fill="none" />
                                            <polygon class="rating__star-fill" points="0,15 4.41,6.07 14.27,4.64 7.13,-2.32 8.82,-12.14 0,-7.5 -8.82,-12.14 -7.13,-2.32 -14.27,4.64 -4.41,6.07" fill="#000" />
                                          </g>
                                          <g transform="translate(16,16)" stroke-dasharray="12 12" stroke-dashoffset="12">
                                            <polyline class="rating__star-line" transform="rotate(0)" points="0 4,0 16" />
                                            <polyline class="rating__star-line" transform="rotate(72)" points="0 4,0 16" />
                                            <polyline class="rating__star-line" transform="rotate(144)" points="0 4,0 16" />
                                            <polyline class="rating__star-line" transform="rotate(216)" points="0 4,0 16" />
                                            <polyline class="rating__star-line" transform="rotate(288)" points="0 4,0 16" />
                                          </g>
                                        </g>
                                      </svg>
                                      <span class="rating__sr">3 stars—OK</span>
                                    </label>
                                    <label class="rating__label" for="rating-4">
                                      <svg class="rating__star" width="32" height="32" viewBox="0 0 32 32" aria-hidden="true">
                                        <g transform="translate(16,16)">
                                          <circle class="rating__star-ring" fill="none" stroke="#000" stroke-width="16" r="8" transform="scale(0)" />
                                        </g>
                                        <g stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                          <g transform="translate(16,16) rotate(180)">
                                            <polygon class="rating__star-stroke" points="0,15 4.41,6.07 14.27,4.64 7.13,-2.32 8.82,-12.14 0,-7.5 -8.82,-12.14 -7.13,-2.32 -14.27,4.64 -4.41,6.07" fill="none" />
                                            <polygon class="rating__star-fill" points="0,15 4.41,6.07 14.27,4.64 7.13,-2.32 8.82,-12.14 0,-7.5 -8.82,-12.14 -7.13,-2.32 -14.27,4.64 -4.41,6.07" fill="#000" />
                                          </g>
                                          <g transform="translate(16,16)" stroke-dasharray="12 12" stroke-dashoffset="12">
                                            <polyline class="rating__star-line" transform="rotate(0)" points="0 4,0 16" />
                                            <polyline class="rating__star-line" transform="rotate(72)" points="0 4,0 16" />
                                            <polyline class="rating__star-line" transform="rotate(144)" points="0 4,0 16" />
                                            <polyline class="rating__star-line" transform="rotate(216)" points="0 4,0 16" />
                                            <polyline class="rating__star-line" transform="rotate(288)" points="0 4,0 16" />
                                          </g>
                                        </g>
                                      </svg>
                                      <span class="rating__sr">4 stars—Good</span>
                                    </label>
                                    <label class="rating__label" for="rating-5">
                                      <svg class="rating__star" width="32" height="32" viewBox="0 0 32 32" aria-hidden="true">
                                        <g transform="translate(16,16)">
                                          <circle class="rating__star-ring" fill="none" stroke="#000" stroke-width="16" r="8" transform="scale(0)" />
                                        </g>
                                        <g stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                          <g transform="translate(16,16) rotate(180)">
                                            <polygon class="rating__star-stroke" points="0,15 4.41,6.07 14.27,4.64 7.13,-2.32 8.82,-12.14 0,-7.5 -8.82,-12.14 -7.13,-2.32 -14.27,4.64 -4.41,6.07" fill="none" />
                                            <polygon class="rating__star-fill" points="0,15 4.41,6.07 14.27,4.64 7.13,-2.32 8.82,-12.14 0,-7.5 -8.82,-12.14 -7.13,-2.32 -14.27,4.64 -4.41,6.07" fill="#000" />
                                          </g>
                                          <g transform="translate(16,16)" stroke-dasharray="12 12" stroke-dashoffset="12">
                                            <polyline class="rating__star-line" transform="rotate(0)" points="0 4,0 16" />
                                            <polyline class="rating__star-line" transform="rotate(72)" points="0 4,0 16" />
                                            <polyline class="rating__star-line" transform="rotate(144)" points="0 4,0 16" />
                                            <polyline class="rating__star-line" transform="rotate(216)" points="0 4,0 16" />
                                            <polyline class="rating__star-line" transform="rotate(288)" points="0 4,0 16" />
                                          </g>
                                        </g>
                                      </svg>
                                      <span class="rating__sr">5 stars—Excellent</span>
                                    </label>
                                    <p class="rating__display" data-rating="1" hidden>Terrible</p>
                                    <p class="rating__display" data-rating="2" hidden>Bad</p>
                                    <p class="rating__display" data-rating="3" hidden>OK</p>
                                    <p class="rating__display" data-rating="4" hidden>Good</p>
                                    <p class="rating__display" data-rating="5" hidden>Excellent</p>
                                  {{-- </div> --}}
                                </div>

                                <div class="form-floating form-floating-outline mb-4">
                                  <textarea class="form-control h-px-100" name="content" id="exampleFormControlTextarea1" placeholder="{{ __('Comments here...') }}"></textarea>
                                  <label for="exampleFormControlTextarea1">{{ __('Your Comment') }}</label>
                                </div>
                                <button type="submit" class="btn btn-primary my-3">
                                  <span class="tf-icons mdi mdi-checkbox-marked-circle-outline mx-1"></span>{{ __('Send') }}
                                </button>
                              </form>
                      </div>
                    @endauth
                </div>
                </div>
              </div>
            </div>
          </div>
      </div>
  </div>
  <!-- Shop Detail End -->



  <style>
.carousel-item.active {
  display: flex !important;
  justify-content: center !important;
}
:root {
  --bg: hsl(223, 10%, 90%);
  --fg: hsl(223, 10%, 10%);
  --primary: hsl(223, 90%, 55%);
  --yellow: hsl(38, 90%, 55%);
  --yellow-t: hsla(38, 90%, 55%, 0);
  --bezier: cubic-bezier(0.42, 0, 0.58, 1);
  --trans-dur: 0.3s;
}

  .rating {
	  margin: auto;
  }

  .rating__display {
		font-size: 1em;
		font-weight: 500;
		min-height: 1.25em;
		position: absolute;
		top: 100%;
		width: 100%;
		text-align: center;
  }
  .rating__stars {
		display: flex;
		padding-bottom: 0.375em;
		position: relative;
	}
  .rating__star {
		display: block;
		overflow: visible;
		pointer-events: none;
		width: 2em;
		height: 2em;
  }
    .rating__star-ring,
    .rating__star-fill,
		.rating__star-line,
		.rating__star-stroke {
			animation-duration: 1s;
			animation-timing-function: ease-in-out;
			animation-fill-mode: forwards;
		}
		.rating__star-ring,
		.rating__star-fill,
		.rating__star-line {
			stroke: var(--yellow);
		}
		.rating__star-fill {
			fill: var(--yellow);
			transform: scale(0);
			transition:
				fill var(--trans-dur) var(--bezier),
				transform var(--trans-dur) var(--bezier);
		}
		.rating__star-line {
			stroke-dasharray: 12 13;
			stroke-dashoffset: -13;
		}
		.rating__star-stroke {
			stroke: hsl(223,10%,80%);
			transition: stroke var(--trans-dur);
		}

  .rating__label {
		cursor: pointer;
		padding: 0.125em;
	}

  .rating__label--delay1 .rating__star-ring,
  .rating__label--delay1 .rating__star-fill,
  .rating__label--delay1 .rating__star-line,
  .rating__label--delay1 .rating__star-stroke {
      animation-delay: 0.05s;
  }

  .rating__label--delay2 .rating__star-ring,
  .rating__label--delay2 .rating__star-fill,
  .rating__label--delay2 .rating__star-line,
  .rating__label--delay2 .rating__star-stroke {
      animation-delay: 0.1s;
  }

  .rating__label--delay3 .rating__star-ring,
  .rating__label--delay3 .rating__star-fill,
  .rating__label--delay3 .rating__star-line,
  .rating__label--delay3 .rating__star-stroke {
      animation-delay: 0.15s;
  }

  .rating__label--delay4 .rating__star-ring,
  .rating__label--delay4 .rating__star-fill,
  .rating__label--delay4 .rating__star-line,
  .rating__label--delay4 .rating__star-stroke {
      animation-delay: 0.2s;
  }

	.rating__input {
		position: absolute;
		-webkit-appearance: none;
		appearance: none;
	}

	.rating__input:hover ~ [data-rating]:not([hidden]) {
		display: none;
	}

	.rating__input-1:hover ~ [data-rating="1"][hidden],
	.rating__input-2:hover ~ [data-rating="2"][hidden],
	.rating__input-3:hover ~ [data-rating="3"][hidden],
	.rating__input-4:hover ~ [data-rating="4"][hidden],
	.rating__input-5:hover ~ [data-rating="5"][hidden],
	.rating__input:checked:hover ~ [data-rating]:not([hidden]) {
		display: block;
	}



	.rating__input-1:hover ~ .rating__label:first-of-type .rating__star-stroke,
	.rating__input-2:hover ~ .rating__label:nth-of-type(-n + 2) .rating__star-stroke,
	.rating__input-3:hover ~ .rating__label:nth-of-type(-n + 3) .rating__star-stroke,
	.rating__input-4:hover ~ .rating__label:nth-of-type(-n + 4) .rating__star-stroke,
	.rating__input-5:hover ~ .rating__label:nth-of-type(-n + 5) .rating__star-stroke {
		stroke: var(--yellow);
		transform: scale(1);
	}
	.rating__input-1:checked ~ .rating__label:first-of-type .rating__star-ring,
	.rating__input-2:checked ~ .rating__label:nth-of-type(-n + 2) .rating__star-ring,
	.rating__input-3:checked ~ .rating__label:nth-of-type(-n + 3) .rating__star-ring,
	.rating__input-4:checked ~ .rating__label:nth-of-type(-n + 4) .rating__star-ring,
	.rating__input-5:checked ~ .rating__label:nth-of-type(-n + 5) .rating__star-ring {
		animation-name: starRing;
	}
	.rating__input-1:checked ~ .rating__label:first-of-type .rating__star-stroke,
	.rating__input-2:checked ~ .rating__label:nth-of-type(-n + 2) .rating__star-stroke,
	.rating__input-3:checked ~ .rating__label:nth-of-type(-n + 3) .rating__star-stroke,
	.rating__input-4:checked ~ .rating__label:nth-of-type(-n + 4) .rating__star-stroke,
	.rating__input-5:checked ~ .rating__label:nth-of-type(-n + 5) .rating__star-stroke {
		animation-name: starStroke;
	}
	.rating__input-1:checked ~ .rating__label:first-of-type .rating__star-line,
	.rating__input-2:checked ~ .rating__label:nth-of-type(-n + 2) .rating__star-line,
	.rating__input-3:checked ~ .rating__label:nth-of-type(-n + 3) .rating__star-line,
	.rating__input-4:checked ~ .rating__label:nth-of-type(-n + 4) .rating__star-line,
	.rating__input-5:checked ~ .rating__label:nth-of-type(-n + 5) .rating__star-line {
		animation-name: starLine;
	}
	.rating__input-1:checked ~ .rating__label:first-of-type .rating__star-fill,
	.rating__input-2:checked ~ .rating__label:nth-of-type(-n + 2) .rating__star-fill,
	.rating__input-3:checked ~ .rating__label:nth-of-type(-n + 3) .rating__star-fill,
	.rating__input-4:checked ~ .rating__label:nth-of-type(-n + 4) .rating__star-fill,
	.rating__input-5:checked ~ .rating__label:nth-of-type(-n + 5) .rating__star-fill {
		animation-name: starFill;
	}
	.rating__input-1:not(:checked):hover ~ .rating__label:first-of-type .rating__star-fill,
	.rating__input-2:not(:checked):hover ~ .rating__label:nth-of-type(2) .rating__star-fill,
	.rating__input-3:not(:checked):hover ~ .rating__label:nth-of-type(3) .rating__star-fill,
	.rating__input-4:not(:checked):hover ~ .rating__label:nth-of-type(4) .rating__star-fill,
	.rating__input-5:not(:checked):hover ~ .rating__label:nth-of-type(5) .rating__star-fill {
		fill: var(--yellow-t);
	}


	.rating__sr {
		clip: rect(1px,1px,1px,1px);
		overflow: hidden;
		position: absolute;
		width: 1px;
		height: 1px;
	}




@media (prefers-color-scheme: dark) {
	:root {
		--bg: hsl(223,10%,10%);
		--fg: hsl(223,10%,90%);
	}
	.rating {
		margin: auto;
  }
  .rating__star-stroke {
      stroke: hsl(223,10%,30%);
  }
}

@keyframes starRing {
	from,
	20% {
		animation-timing-function: ease-in;
		opacity: 1;
		r: 8px;
		stroke-width: 16px;
		transform: scale(0);
	}
	35% {
		animation-timing-function: ease-out;
		opacity: 0.5;
		r: 8px;
		stroke-width: 16px;
		transform: scale(1);
	}
	50%,
	to {
		opacity: 0;
		r: 16px;
		stroke-width: 0;
		transform: scale(1);
	}
}
@keyframes starFill {
	from,
	40% {
		animation-timing-function: ease-out;
		transform: scale(0);
	}
	60% {
		animation-timing-function: ease-in-out;
		transform: scale(1.2);
	}
	80% {
		transform: scale(0.9);
	}
	to {
		transform: scale(1);
	}
}
@keyframes starStroke {
	from {
		transform: scale(1);
	}
	20%,
	to {
		transform: scale(0);
	}
}
@keyframes starLine {
	from,
	40% {
		animation-timing-function: ease-out;
		stroke-dasharray: 1 23;
		stroke-dashoffset: 1;
	}
	60%,
	to {
		stroke-dasharray: 12 13;
		stroke-dashoffset: -13;
	}
}
</style>

<script>
    var lang = "{{ app()->getLocale() }}";

    window.addEventListener("DOMContentLoaded",() => {
      const starRating = new StarRating(".rating__stars");
    });

    class StarRating {
      constructor(qs) {
        this.ratings = [
          {id: 1, name: "Terrible"},
          {id: 2, name: "Bad"},
          {id: 3, name: "OK"},
          {id: 4, name: "Good"},
          {id: 5, name: "Excellent"}
        ];
        this.rating = null;
        this.el = document.querySelector(qs);

        this.init();
      }
      init() {
        this.el?.addEventListener("change",this.updateRating.bind(this));

        // stop Firefox from preserving form data between refreshes
        try {
          this.el?.reset();
        } catch (err) {
          console.error("Element isn’t a form.");
        }
      }
      updateRating(e) {
        // clear animation delays
        Array.from(this.el.querySelectorAll(`[for*="rating"]`)).forEach(el => {
          el.className = "rating__label";
        });

        const ratingObject = this.ratings.find(r => r.id === +e.target.value);
        const prevRatingID = this.rating?.id || 0;

        let delay = 0;
        this.rating = ratingObject;
        this.ratings.forEach(rating => {
          const { id } = rating;

          // add the delays
          const ratingLabel = this.el.querySelector(`[for="rating-${id}"]`);

          if (id > prevRatingID + 1 && id <= this.rating.id) {
            ++delay;
            ratingLabel.classList.add(`rating__label--delay${delay}`);
          }

          // hide ratings to not read, show the one to read
          const ratingTextEl = this.el.querySelector(`[data-rating="${id}"]`);

          if (this.rating.id !== id)
            ratingTextEl.setAttribute("hidden",true);
          else
            ratingTextEl.removeAttribute("hidden");
        });
      }
    }


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

    $(document).on('click', '.btn-plus-product', function() {
    var inputQuantity = $(this).siblings('.input-price-product');
    var maxQuantity = parseInt(inputQuantity.attr('max'));

    if (parseInt(inputQuantity.val()) < maxQuantity) {
        inputQuantity.val(parseInt(inputQuantity.val()) + 1);
    }
});


$(document).on('click', '.btn-minus-product', function() {
    var inputQuantity = $(this).siblings('.input-price-product');

    if (parseInt(inputQuantity.val()) > 1) {
        inputQuantity.val(parseInt(inputQuantity.val()) - 1);
    }
});

    //     $('#addCommentForm').submit(function(event) {
    //     event.preventDefault();

    //     var formData = $(this).serialize();

    //     $.ajax({
    //       url: $(this).attr('action'),
    //       type: $(this).attr('method'),
    //       data: formData,
    //       dataType: 'json',
    //       success: function(response) {
    //         Swal.fire({
    //           icon: response.icon,
    //           title: response.state,
    //           text: response.message,
    //           confirmButtonText: __("Ok",lang)
    //         });
    //       },
    //       error: function(xhr, textStatus, errorThrown) {
    //         const response = JSON.parse(xhr.responseText);
    //         Swal.fire({
    //           icon: response.icon,
    //           title: response.state,
    //           text: response.message,
    //           confirmButtonText: __("Ok",lang)
    //         });
    //       }
    //     });
    // });

  </script>

@else
<x-placeholder></x-placeholder>
@endif
@endsection
