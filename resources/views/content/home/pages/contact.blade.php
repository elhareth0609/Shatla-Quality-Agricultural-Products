@extends('layouts.homeLayout')

@section('title', __('Contact'))

@section('content')

<div class="container-fluid pt-5">
  <div class="row justify-content-center mb-5">
    <div class="col-md-8 text-center my-w-fit-content">
      <h1 class="mb-4">{{ __('Contact Us') }}</h1>
      <div class="border-bottom border-dark"></div>
    </div>
  </div>
    <div class="row px-xl-5">
        <div class="col-lg-7 mb-5" dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}">
            <div class="contact-form">
                <div id="success"></div>
                <form name="sentMessage" id="contactForm" novalidate="novalidate">
                    <div class="control-group">
                        <input type="text" class="form-control" id="name" placeholder="{{__('Full Name')}}"
                            required="required" data-validation-required-message="Please enter your name" />
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="control-group">
                        <input type="email" class="form-control" id="email" placeholder="{{__('Email')}}"
                            required="required" data-validation-required-message="Please enter your email" />
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="control-group">
                        <input type="text" class="form-control" id="subject" placeholder="{{__('Subject')}}"
                            required="required" data-validation-required-message="Please enter a subject" />
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="control-group">
                        <textarea class="form-control" rows="6" id="message" placeholder="{{ __('Message') }}"
                            required="required"
                            data-validation-required-message="Please enter your message"></textarea>
                        <p class="help-block text-danger"></p>
                    </div>
                    <div>
                        <button class="btn btn-primary py-2 px-4 {{ app()->isLocale('ar') ? 'float-start' : 'float-end' }}"  type="submit" id="sendMessageButton">{{ __('Send') }}</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-5 mb-5" dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}">
          <h5 class="font-weight-semi-bold mb-3">{{ __('Get In Touch') }}</h5>
          <p>{{ __('We are always here to help and answer any questions you may have. Feel free to reach out to us through the following contact details:') }}</p>

            <div class="d-flex flex-column mb-3">
                {{-- <h5 class="font-weight-semi-bold mb-3">Store 1</h5> --}}
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>الوادي ,حساني عبد الكريم ,الزقم</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>hareth0609@gmail.com</p>
                <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>+213 07 95909128</p>
            </div>
        </div>
    </div>
</div>

@endsection
