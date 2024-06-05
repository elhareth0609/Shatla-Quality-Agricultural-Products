@extends('layouts.homeLayout')

@section('title', __('Check Out'))

@section('content')
<div class="container-fluid pt-5">
  <form class="row px-xl-5" dir="{{ app()->isLocale('ar') ? 'rtl' : 'ltr' }}" action="{{ route('cart.order') }}" method="Post" id="orderForm">
    @csrf
      <div class="col-lg-8">

          <div class="card p-3 mb-4" id="newAddressForm">
              <h4 class="font-weight-semi-bold mb-4">{{ __('Billing Address') }}</h4>
              <input type="hidden" name="coupon_id" value="{{ $coupon ? $coupon->id : null }}" />
              <div class="row">
                  <div class="col-md-6 form-group">
                    <div class="form-floating form-floating-outline mb-4">
                      <input type="name" name="first_name" class="form-control" id="exampleFormControlInput1" placeholder="{{ __('Enter First Name') }}" />
                      <label for="exampleFormControlInput1">{{ __('First Name') }}</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-floating form-floating-outline mb-4">
                      <input type="name" name="last_name" class="form-control" id="exampleFormControlInput1" placeholder="{{ __('Enter Last Name') }}" />
                      <label for="exampleFormControlInput1">{{ __('Last Name') }}</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-floating form-floating-outline mb-4">
                      <input type="tel" name="phone1" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" />
                      <label for="exampleFormControlInput1">{{ __('Phone') }}1</label>
                    </div>
                  </div>
                  <div class="col-md-6 form-group">
                    <div class="form-floating form-floating-outline mb-4">
                      <input class="form-control" name="phone2" type="tel" placeholder="90-(164)-188-556" id="html5-tel-input" />
                      <label for="html5-tel-input">{{ __('Phone') }}2</label>
                    </div>
                  </div>
                  <div class="col-md-6 form-group">
                    <select id="countrySelect" name="country" class="form-select form-select-lg mb-4 my-p-select text-start">
                      <option>{{ __('Select Country') }}</option>
                      @foreach($countries as $country)
                        <option value="{{ $country['id'] }}">{{ $country['name'] }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-6 form-group">
                    <select id="stateSelect" name="state" class="form-select form-select-lg mb-4 my-p-select text-start">
                      <option>{{ __('Select State') }}</option>
                    </select>
                  </div>
                  <div class="col-md-6 form-group">
                    <select id="citySelect" name="city" class="form-select form-select-lg mb-4 my-p-select text-start">
                      <option>{{ __('Select City') }}</option>
                    </select>
                  </div>
                  <div class="col-md-6 form-group">
                    <div class="form-floating form-floating-outline mb-4">
                      <input class="form-control" name="zip" type="number" placeholder="39000" id="html5-number-input" />
                      <label for="html5-number-input">{{ __('Zip Code') }}</label>
                    </div>
                  </div>
                  <div class="col-md-6 form-group">
                      <div class="form-floating form-floating-outline mb-4">
                        <input class="form-control" name="address1" type="text" placeholder="123 Street" id="html5-text-input" />
                        <label for="html5-text-input">{{ __('Address Line 1') }}</label>
                      </div>
                  </div>
                  <div class="col-md-6 form-group">
                      <div class="form-floating form-floating-outline mb-4">
                        <input class="form-control" name="address2" type="text" placeholder="123 Street" id="html5-text-input" />
                        <label for="html5-text-input">{{ __('Address Line 2') }}</label>
                      </div>
                  </div>
              </div>
          </div>




      </div>
      <div class="col-lg-4">
          <div class="card border-secondary mb-5">
              <div class="card-header border-0 bg-primary">
                  <h4 class="font-weight-semi-bold m-0 text-white">{{ __('Order Total') }}</h4>
              </div>
              <div class="card-body">
                  @foreach (Auth::user()->cart->products as $product)
                    <div class="d-flex justify-content-between">
                        <p>{{ \Illuminate\Support\Str::limit($product->product->name, 20) }}</p>
                        @if(session('currency', config('currency.default_currency')) === 'DZ')
                            <p class="d-flex m-0" id="total-cart">{{ $product->product->price }} {{ config('currency.currencies.' . session('currency', config('currency.default_currency'))) }}</p>
                        @else
                            <p class="d-flex m-0" id="total-cart">{{ config('currency.currencies.' . session('currency', config('currency.default_currency'))) }} {{ $product->product->price }}</p>
                        @endif
                    </div>
                  @endforeach
                  <hr class="mt-0">
                  <div class="d-flex justify-content-between mb-3 pt-1">
                      <h6 class="font-weight-medium">{{ __('Subtotal') }}</h6>
                      <h5 class="font-weight-medium d-flex">
                    @php
                      $shipping = App\Models\Details::where('type', 'shipping')->first()->content;
                    @endphp
                        @if(session('currency', config('currency.default_currency')) === 'DZ')
                            <p class="d-flex m-0" id="total-cart">{{ Auth::user()->cart->totalCart() }}</p>{{ config('currency.currencies.' . session('currency', config('currency.default_currency'))) }}
                        @else
                            {{ config('currency.currencies.' . session('currency', config('currency.default_currency'))) }}<p class="d-flex m-0" id="total-cart">{{ Auth::user()->cart->totalCart() + $shipping }}</p>
                        @endif
                      </h5>                  </div>
                  <div class="d-flex justify-content-between mb-3">
                    <h6 class="font-weight-medium">{{ __('Shipping') }}</h6>
                    <h6 class="font-weight-medium d-flex">
                      @if(session('currency', config('currency.default_currency')) === 'DZ')
                          <p class="d-flex m-0" id="shipping-cart">{{ $shipping }}</p>{{ config('currency.currencies.' . session('currency', config('currency.default_currency'))) }}
                      @else
                          {{ config('currency.currencies.' . session('currency', config('currency.default_currency'))) }}<p class="d-flex m-0" id="shipping-cart">{{ $shipping }}</p>
                      @endif
                    </h6>
                  </div>
                  <div class="d-flex justify-content-between">
                    <h6 class="font-weight-medium">{{ __('Coupon') }}</h6>
                    <h6 class="font-weight-medium">{{ $coupon ? $coupon->discount : 0 }}%</h6>
                  </div>
                  <hr class="mt-0">

              </div>
              <div class="card-footer border-secondary bg-transparent">
                  <div class="d-flex justify-content-between mt-2">
                    <h5 class="font-weight-bold">{{ __('Total') }}</h5>
                    <h5 class="font-weight-bold d-flex">
                      @if(session('currency', config('currency.default_currency')) === 'DZ')
                          <p class="d-flex m-0" id="total-cart">{{ (Auth::user()->cart->totalCart() * ($coupon ? $coupon->discount/100 : 1)) + $shipping }}</p>{{ config('currency.currencies.' . session('currency', config('currency.default_currency'))) }}
                      @else
                          {{ config('currency.currencies.' . session('currency', config('currency.default_currency'))) }}<p class="d-flex m-0" id="total-cart">{{ (Auth::user()->cart->totalCart() * ($coupon ? $coupon->discount/100 : 1)) + $shipping }}</p>
                      @endif
                    </h5>
                  </div>
              </div>
          </div>
          <div class="card border-secondary mb-5">
              <div class="card-header border-0 bg-primary">
                  <h4 class="font-weight-semi-bold m-0 text-white">{{ __('Payment') }}</h4>
              </div>
              <div class="card-body">
                <div class="form-check mt-3">
                  <input class="form-check-input" name="payment_method" type="radio" value="upon-receipt" id="upon-receipt" checked />
                  <label class="form-check-label" for="defaultCheck1">
                    {{ __('Upon receipt') }}
                  </label>
                </div>
                <div class="form-check mt-3">
                  <input class="form-check-input" name="payment_method" type="radio" value="gold-card" id="gold-card" />
                  <label class="form-check-label" for="defaultCheck1">
                    {{ __('Gold card') }}
                  </label>
                </div>
                <div class="form-check mt-3">
                  @if (app()->getLocale() == 'ar')
                    <label class="form-check-label" for="defaultCheck1">
                      {{ __('Baridi Mob') }}
                    </label>
                  @endif
                  <input class="form-check-input" name="payment_method" type="radio" value="baridi-mob" id="baridi-mob" />
                  @if (app()->getLocale() != 'ar')
                    <label class="form-check-label" for="defaultCheck1">
                      {{ __('Baridi Mob') }}
                    </label>
                  @endif
                </div>
              </div>
              <div class="card-footer border-secondary bg-transparent">
                  <button class="btn btn-primary {{ app()->isLocale('ar') ? 'float-start' : 'float-end' }}">{{ __('Place Order') }}</button>
              </div>
          </div>
      </div>
  </form>
</div>

<script>
  var lang = "{{ app()->getLocale() }}";


  $(document).ready(function() {

    $('#countrySelect').on('change', function() {
        var countryId = $(this).val();
        if (countryId) {
            $.ajax({
                type: 'GET',
                url: '/get-states/' + countryId,
                success: function(response) {
                    $('#stateSelect').empty();
                    $('#stateSelect').append('<option value="">{{ __('Select State') }}</option>');
                    var states = response.data;
                    states.forEach(function(state) {
                    $('#stateSelect').append('<option value="' + state.id + '">' + state.name + '</option>');
                });
                }
            });
        } else {
            $('#stateSelect').empty();
            $('#stateSelect').append('<option value="">{{ __('Select State') }}</option>');
        }
    });

    $('#stateSelect').on('change', function() {
        var stateId = $(this).val();
        var countryId = $('#countrySelect').val();
        if (stateId && countryId) {
            $.ajax({
                type: 'GET',
                url: '/get-cities/' + countryId + '/' + stateId ,
                success: function(response) {
                  var cities = response.data;
                    $('#citySelect').empty();
                    $('#citySelect').append('<option value="">{{ __('Select City') }}</option>');

                    cities.forEach(function(city) {
                    $('#citySelect').append('<option value="' + city.id + '">' + city.name + '</option>');
                });
                }
            });
        } else {
            $('#stateSelect').empty();
            $('#stateSelect').append('<option value="">{{ __('Select City') }}</option>');
        }
    });

    $('#orderForm').submit(function(event) {
      event.preventDefault();

      var formData = new FormData(this);

      $.ajax({
          url: $(this).attr('action'),
          type: $(this).attr('method'),
          data: formData,
          dataType: "json",
          contentType: false,
          processData: false,
          success: function(response) {
              Swal.fire({
                  icon: response.icon,
                  title: response.state,
                  text: response.message,
                  confirmButtonText: __("Ok",lang)
                }).then((result) => {
                    if (result.isConfirmed) {
                      if (response.payment_method == 'gold-card') {
                        window.location.href = response.url;
                      }
                    }
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
  });
</script>
@endsection
