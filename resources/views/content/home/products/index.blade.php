@extends('layouts.homeLayout')

@section('title', '')

@section('content')

    <!-- Shop Detail Start -->
    <div class="container-fluid py-5" dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}">
      <div class="row px-xl-5">
          <div class="col-lg-5 pb-5">

            {{-- <div class="col-md">
              <h5 class="my-4">Bootstrap carousel</h5> --}}

              <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                  <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="1" aria-label="Slide 2"></button>
                  <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner rounded">
                  <div class="carousel-item active">
                    <img class="d-block w-100" src="{{asset('assets/img/elements/13.jpg')}}" alt="First slide" />
                    <div class="carousel-caption d-none d-md-block">
                      <h3>First slide</h3>
                      <p>Eos mutat malis maluisset et, agam ancillae quo te, in vim congue pertinacia.</p>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <img class="d-block w-100" src="{{asset('assets/img/elements/2.jpg')}}" alt="Second slide" />
                    <div class="carousel-caption d-none d-md-block">
                      <h3>Second slide</h3>
                      <p>In numquam omittam sea.</p>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <img class="d-block w-100" src="{{asset('assets/img/elements/18.jpg')}}" alt="Third slide" />
                    <div class="carousel-caption d-none d-md-block">
                      <h3>Third slide</h3>
                      <p>Lorem ipsum dolor sit amet, virtute consequat ea qui, minim graeco mel no.</p>
                    </div>
                  </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExample" role="button" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExample" role="button" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </a>
              </div>
            {{-- </div> --}}





            {{--
              <div id="product-carousel" class="carousel slide" data-ride="carousel">
                  <div class="carousel-inner border">
                      <div class="carousel-item active">
                          <img class="w-100 h-100" src="{{ asset('assets/home/images/banner-1.png') }}" alt="Image">
                      </div>
                      <div class="carousel-item">
                          <img class="w-100 h-100" src="{{ asset('assets/home/images/banner-1.png') }}" alt="Image">
                      </div>
                      <div class="carousel-item">
                          <img class="w-100 h-100" src="{{ asset('assets/home/images/banner-1.png') }}" alt="Image">
                      </div>
                      <div class="carousel-item">
                          <img class="w-100 h-100" src="{{ asset('assets/home/images/banner-1.png') }}" alt="Image">
                      </div>
                  </div>
                  <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                      <i class="fa fa-2x fa-angle-left text-dark"></i>
                  </a>
                  <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                      <i class="fa fa-2x fa-angle-right text-dark"></i>
                  </a>
              </div>
          </div> --}}
          </div>
          <div class="col-lg-7 pb-5">
              <h3 class="font-weight-semi-bold">Colorful Stylish Shirt</h3>
              <div class="d-flex mb-3">
                  <div class="text-primary mr-2">
                      <small class="fas fa-star"></small>
                      <small class="fas fa-star"></small>
                      <small class="fas fa-star"></small>
                      <small class="fas fa-star-half-alt"></small>
                      <small class="far fa-star"></small>
                  </div>
                  <small class="pt-1">(50 Reviews)</small>
              </div>
              <h3 class="font-weight-semi-bold mb-4">$150.00</h3>
              <p class="mb-4">Volup erat ipsum diam elitr rebum et dolor. Est nonumy elitr erat diam stet sit clita ea. Sanc invidunt ipsum et, labore clita lorem magna lorem ut. Erat lorem duo dolor no sea nonumy. Accus labore stet, est lorem sit diam sea et justo, amet at lorem et eirmod ipsum diam et rebum kasd rebum.</p>
              <div class="row">
                <div class="col-6">
                  <div class="input-group input-group-merge" dir="{{ app()->isLocale('ar') ? 'ltr' : '' }}">
                    <span class="input-group-text">{{ __('Quantity') }}</span>
                    <input type="number" class="form-control" placeholder="0" value="1" aria-label="Amount (to the nearest dollar)" max="" min=""/>
                  </div>
                </div>
                <div class="col-6">
                  <div class="input-group input-group-merge" >
                    <button type="button" class="btn btn-outline-primary">
                      <span class="tf-icons mdi mdi-cart-check mx-1"></span>{{ __('Add To Cart') }}
                    </button>
                  </div>
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
                  <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-home" aria-controls="navs-justified-home" aria-selected="true"><i class="tf-icons mdi mdi-home-outline me-1"></i><span class="d-none d-sm-block">{{ __('Home') }}</span></button>
                </li>
                <li class="nav-item">
                  <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-profile" aria-controls="navs-justified-profile" aria-selected="false"><i class="tf-icons mdi mdi-account-outline me-1"></i><span class="d-none d-sm-block">{{ __('Profile') }}</span></button>
                </li>
                <li class="nav-item">
                  <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-messages" aria-controls="navs-justified-messages" aria-selected="false"><i class="tf-icons mdi mdi-message-text-outline me-1"></i><span class="d-none d-sm-block">{{ __('Messages') }}</span><span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-label-danger ms-1">3</span></button>
                </li>
              </ul>
            </div>
          </div>
          <div class="card-body">
            <div class="tab-content p-0">
              <div class="tab-pane fade show active" id="navs-justified-home" role="tabpanel">
                  <h4 class="mb-3">Product Description</h4>
                  <p>Eos no lorem eirmod diam diam, eos elitr et gubergren diam sea. Consetetur vero aliquyam invidunt duo dolores et duo sit. Vero diam ea vero et dolore rebum, dolor rebum eirmod consetetur invidunt sed sed et, lorem duo et eos elitr, sadipscing kasd ipsum rebum diam. Dolore diam stet rebum sed tempor kasd eirmod. Takimata kasd ipsum accusam sadipscing, eos dolores sit no ut diam consetetur duo justo est, sit sanctus diam tempor aliquyam eirmod nonumy rebum dolor accusam, ipsum kasd eos consetetur at sit rebum, diam kasd invidunt tempor lorem, ipsum lorem elitr sanctus eirmod takimata dolor ea invidunt.</p>
                  <p>Dolore magna est eirmod sanctus dolor, amet diam et eirmod et ipsum. Amet dolore tempor consetetur sed lorem dolor sit lorem tempor. Gubergren amet amet labore sadipscing clita clita diam clita. Sea amet et sed ipsum lorem elitr et, amet et labore voluptua sit rebum. Ea erat sed et diam takimata sed justo. Magna takimata justo et amet magna et.</p>
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
                        <h4 class="mb-4">1 review for "Colorful Stylish Shirt"</h4>
                        <div class="media mb-4">
                            <img src="{{ asset('assets/home/images/banner-1.png') }}" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
                            <div class="media-body">
                                <h6>John Doe<small> - <i>01 Jan 2045</i></small></h6>
                                <div class="text-primary mb-2">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                    <i class="far fa-star"></i>
                                </div>
                                <p>Diam amet duo labore stet elitr ea clita ipsum, tempor labore accusam ipsum et no at. Kasd diam tempor rebum magna dolores sed sed eirmod ipsum.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h4 class="mb-4">Leave a review</h4>
                        <small>Your email address will not be published. Required fields are marked *</small>
                        <div class="d-flex my-3">
                            <p class="mb-0 mr-2">Your Rating * :</p>
                            <div class="text-primary">
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                        </div>
                        <form>
                            <div class="form-group">
                                <label for="message">Your Review *</label>
                                <textarea id="message" cols="30" rows="5" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="name">Your Name *</label>
                                <input type="text" class="form-control" id="name">
                            </div>
                            <div class="form-group">
                                <label for="email">Your Email *</label>
                                <input type="email" class="form-control" id="email">
                            </div>
                            <div class="form-group mb-0">
                                <input type="submit" value="Leave Your Review" class="btn btn-primary px-3">
                            </div>
                        </form>
                    </div>
                </div>
                  {{-- <p>
                    Oat cake chupa chups dragée donut toffee. Sweet cotton candy jelly beans macaroon gummies cupcake gummi
                    bears
                    cake chocolate.
                  </p>
                  <p class="mb-0">
                    Cake chocolate bar cotton candy apple pie tootsie roll ice cream apple pie brownie cake. Sweet roll icing
                    sesame snaps caramels danish toffee. Brownie biscuit dessert dessert. Pudding jelly jelly-o tart brownie
                    jelly.
                  </p> --}}
                </div>
              </div>
            </div>







              {{-- <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                  <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">Description</a>
                  <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-2">Information</a>
                  <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-3">Reviews (0)</a>
              </div>
              <div class="tab-content">
                  <div class="tab-pane fade show active" id="tab-pane-1">
                      <h4 class="mb-3">Product Description</h4>
                      <p>Eos no lorem eirmod diam diam, eos elitr et gubergren diam sea. Consetetur vero aliquyam invidunt duo dolores et duo sit. Vero diam ea vero et dolore rebum, dolor rebum eirmod consetetur invidunt sed sed et, lorem duo et eos elitr, sadipscing kasd ipsum rebum diam. Dolore diam stet rebum sed tempor kasd eirmod. Takimata kasd ipsum accusam sadipscing, eos dolores sit no ut diam consetetur duo justo est, sit sanctus diam tempor aliquyam eirmod nonumy rebum dolor accusam, ipsum kasd eos consetetur at sit rebum, diam kasd invidunt tempor lorem, ipsum lorem elitr sanctus eirmod takimata dolor ea invidunt.</p>
                      <p>Dolore magna est eirmod sanctus dolor, amet diam et eirmod et ipsum. Amet dolore tempor consetetur sed lorem dolor sit lorem tempor. Gubergren amet amet labore sadipscing clita clita diam clita. Sea amet et sed ipsum lorem elitr et, amet et labore voluptua sit rebum. Ea erat sed et diam takimata sed justo. Magna takimata justo et amet magna et.</p>
                  </div>
                  <div class="tab-pane fade" id="tab-pane-2">
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
                  <div class="tab-pane fade" id="tab-pane-3">
                      <div class="row">
                          <div class="col-md-6">
                              <h4 class="mb-4">1 review for "Colorful Stylish Shirt"</h4>
                              <div class="media mb-4">
                                  <img src="{{ asset('assets/home/images/banner-1.png') }}" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                  <div class="media-body">
                                      <h6>John Doe<small> - <i>01 Jan 2045</i></small></h6>
                                      <div class="text-primary mb-2">
                                          <i class="fas fa-star"></i>
                                          <i class="fas fa-star"></i>
                                          <i class="fas fa-star"></i>
                                          <i class="fas fa-star-half-alt"></i>
                                          <i class="far fa-star"></i>
                                      </div>
                                      <p>Diam amet duo labore stet elitr ea clita ipsum, tempor labore accusam ipsum et no at. Kasd diam tempor rebum magna dolores sed sed eirmod ipsum.</p>
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <h4 class="mb-4">Leave a review</h4>
                              <small>Your email address will not be published. Required fields are marked *</small>
                              <div class="d-flex my-3">
                                  <p class="mb-0 mr-2">Your Rating * :</p>
                                  <div class="text-primary">
                                      <i class="far fa-star"></i>
                                      <i class="far fa-star"></i>
                                      <i class="far fa-star"></i>
                                      <i class="far fa-star"></i>
                                      <i class="far fa-star"></i>
                                  </div>
                              </div>
                              <form>
                                  <div class="form-group">
                                      <label for="message">Your Review *</label>
                                      <textarea id="message" cols="30" rows="5" class="form-control"></textarea>
                                  </div>
                                  <div class="form-group">
                                      <label for="name">Your Name *</label>
                                      <input type="text" class="form-control" id="name">
                                  </div>
                                  <div class="form-group">
                                      <label for="email">Your Email *</label>
                                      <input type="email" class="form-control" id="email">
                                  </div>
                                  <div class="form-group mb-0">
                                      <input type="submit" value="Leave Your Review" class="btn btn-primary px-3">
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div>
              </div> --}}
          </div>
      </div>
  </div>
  <!-- Shop Detail End -->

@endsection
