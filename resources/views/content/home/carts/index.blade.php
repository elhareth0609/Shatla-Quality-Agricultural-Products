@extends('layouts.homeLayout')

@section('title', __('Cart'))

@section('content')

<div class="container-fluid pt-5">
  <div class="row px-xl-5" dir="{{ app()->isLocale('ar') ? 'rtl' : 'ltr' }}">
      <div class="col-lg-8 table-responsive mb-5">
          <table class="table table-bordered text-center mb-0 rounded-3 overflow-hidden">
              <thead class="bg-primary text-dark">
                  <tr>
                      <th class="text-white" colspan="2">{{ __('Products') }}</th>
                      <th class="text-white">{{ __('Price')}}</th>
                      <th class="text-white">{{ __('Quantity')}}</th>
                      <th class="text-white">{{ __('Total')}}</th>
                      <th class="text-white">{{ __('Remove')}}</th>
                  </tr>
              </thead>
              <tbody class="align-middle">
                @foreach (Auth::user()->cart->products as $product)
                  <tr class="carts-item" data-product-id="{{ $product->product->id }}">
                      <td class="align-middle">
                        <img src="{{ $product->product->firstPhoto() }}" alt="" style="width: 50px;">
                      </td>
                      <td class="align-middle">
                        {{ \Illuminate\Support\Str::limit($product->product->name, 30) }}
                      </td>
                      @if(session('currency', config('currency.default_currency')) === 'DZ')
                          <td class="align-middle" dir="rtl"><p class="d-flex m-0" id="price-item-{{ $product->product->id }}">{{ $product->product->price }}</p>{{ config('currency.currencies.' . session('currency', config('currency.default_currency'))) }}</td>
                      @else
                          <td class="align-middle">{{ config('currency.currencies.' . session('currency', config('currency.default_currency'))) }}<p class="d-flex m-0" id="price-item-{{ $product->product->id }}">{{ $product->price }}</p></td>
                      @endif
                      <td class="align-middle">
                        <div class="btn-group" dir="ltr" role="group" aria-label="Second group">
                          <button type="button" class="btn btn-icon btn-primary btn-plus-cart">
                            <span class="tf-icons mdi mdi-plus"></span>
                          </button>
                          <input type="text" class="form-control text-center p-0 rounded-0 my-w-5 input-price-cart" data-max="{{ $product->product->quantity }}" value="{{ $product->quantity }}" name="quantity" data-product-id="{{ $product->product->id }}">
                          <button type="button" class="btn btn-icon btn-primary btn-minus-cart">
                            <span class="tf-icons mdi mdi-minus"></span>
                          </button>
                        </div>
                      </td>
                      @if(session('currency', config('currency.default_currency')) === 'DZ')
                          <td class="align-middle subtotal-item" dir="rtl"><p class="d-flex m-0" id="subtotal-item-{{ $product->product->id }}">{{ $product->product->price * $product->quantity }}</p>{{ config('currency.currencies.' . session('currency', config('currency.default_currency'))) }}</td>
                      @else
                          <td class="align-middle subtotal-item">{{ config('currency.currencies.' . session('currency', config('currency.default_currency'))) }}<p class="d-flex m-0" id="subtotal-item-{{ $product->product->id }}">{{ $product->product->price * $product->pivot->quantity }}</p></td>
                      @endif
                      <td class="align-middle">
                        <button type="button" class="btn btn-icon btn-outline-primary btn-remove-cart">
                          <span class="tf-icons mdi mdi-close"></span>
                        </button>
                      </td>
                  </tr>
                  @endforeach
              </tbody>
          </table>
      </div>
      <form class="col-lg-4" action="{{ route('cart.checkout') }}" method="POST">
        @csrf
        <div class="mb-5">
          <div class="input-group mb-2" dir="ltr">
            @if (app()->getLocale() == 'ar')
              <button class="btn btn-outline-primary" type="button" id="apply-coupon-button">{{ __('Apply') }}</button>
            @endif
              <input type="text" name="coupon" class="form-control" id="coupon-code-input" placeholder="{{ __('Coupon Code') }}" aria-label="Coupon Code" aria-describedby="button-addon2">
            @if (app()->getLocale() != 'ar')
              <button class="btn btn-outline-primary" type="button" id="apply-coupon-button">{{ __('Apply') }}</button>
            @endif
          </div>
          <div class="alert-message"></div>
        </div>
        <div class="card border-secondary mb-5">
          <div class="card-header bg-primary border-0">
              <h4 class="font-weight-semi-bold m-0 text-white">{{ __('Cart Summary') }}</h4>
          </div>
          <div class="card-body">
              <div class="d-flex justify-content-between mb-3 pt-1">
                  <h6 class="font-weight-medium">{{ __('Subtotal') }}</h6>
                  <h6 class="font-weight-medium d-flex">
                    @if(session('currency', config('currency.default_currency')) === 'DZ')
                        <p class="d-flex m-0" id="subtotal-cart">{{ Auth::user()->cart->totalCart() }}</p>{{ config('currency.currencies.' . session('currency', config('currency.default_currency'))) }}
                    @else
                        {{ config('currency.currencies.' . session('currency', config('currency.default_currency'))) }}<p class="d-flex m-0" id="subtotal-cart">{{ Auth::user()->cart->totalCart() }}</p>
                    @endif
                  </h6>
              </div>
              <div class="d-flex justify-content-between mb-3">
                  <h6 class="font-weight-medium">{{ __('Shipping') }}</h6>
                  @php
                    $shipping = App\Models\Details::where('type', 'shipping')->first()->content;
                  @endphp
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
                <h6 class="font-weight-medium" id="discount-coupon">0%</h6>
              </div>
          </div>
          <div class="card-footer border-secondary bg-transparent">
              <div class="d-flex justify-content-between mt-2">
                  <h5 class="font-weight-bold">{{ __('Total') }}</h5>
                  <h5 class="font-weight-bold d-flex">
                    @if(session('currency', config('currency.default_currency')) === 'DZ')
                        <p class="d-flex m-0" id="total-cart">{{ Auth::user()->cart->totalCart() + $shipping }}</p>{{ config('currency.currencies.' . session('currency', config('currency.default_currency'))) }}
                    @else
                        {{ config('currency.currencies.' . session('currency', config('currency.default_currency'))) }}<p class="d-flex m-0" id="total-cart">{{ Auth::user()->cart->totalCart() + $shipping }}</p>
                    @endif
                  </h5>
              </div>
                @if (!Auth::user()->cart->products->count() == 0)
                  <button type="submit" class="btn btn-primary {{ app()->isLocale('ar') ? 'float-start' : 'float-end' }} checkout-btn" id="checkout-btn">{{ __('Checkout') }}</button>
                @endif
              </div>
            </div>
          </div>
        </div>
      </form>
</div>


<script>

  function updateCartInformation() {
    var subtotal = parseFloat($('#subtotal-cart').text());
    var shipping = parseFloat($('#shipping-cart').text());
    var discountPercentage = parseFloat($('#discount-coupon').text());
    var discountedAmount = (subtotal * (discountPercentage / 100)).toFixed(2);
    var totalCartValue = (discountedAmount + shipping).toFixed(2);
    $('#total-cart').text(totalCartValue);
  }

$(document).ready(function() {

    $(document).on('subtotalUpdated', function() {
      var totalSubtotal = 0;

      $('.subtotal-item').each(function() {
        totalSubtotal += parseFloat($(this).text());
      });

      $('#subtotal-cart').text(totalSubtotal.toFixed(2));
      updateCartInformation();
    });


    $('#apply-coupon-button').click(function() {
      var couponCode = $('#coupon-code-input').val();
      if (couponCode.length > 0) {
        applyCoupon(couponCode);
      } else {
        alert('Please enter a valid coupon code.');
      }
    });

    function applyCoupon(couponCode) {
      $.ajax({
          url: '/coupon/check',
          method: 'POST',
          data: {
              code: couponCode,
              _token: csrfToken
          },
          success: function(response) {
            if (response.state) {
                $('.alert-message').removeClass('alert').removeClass('alert-danger').addClass('alert').addClass('alert-success').text(response.message).show();
                $('#discount-coupon').text(response.discount + '%');
                var discountPercentage = response.discount;
                var subtotal = <?php echo Auth::user()->cart->totalCart(); ?>;
                var shipping = <?php echo $shipping; ?>;
                var discountedAmount = subtotal * (discountPercentage / 100);
                var totalCartValue = discountedAmount + shipping;
                $('#total-cart').text(totalCartValue);
            } else {
                $('.alert-message').removeClass('alert').removeClass('alert-success').addClass('alert').addClass('alert-danger').text(response.message).show();
                $('#discount-coupon').text('0' + '%');
                var discountPercentage = 1;
                var shipping = <?php echo $shipping; ?>;
                var subtotal = <?php echo Auth::user()->cart->totalCart(); ?>;
                var totalCartValue = subtotal  + shipping;
                $('#total-cart').text(totalCartValue);
            }
          },
          error: function(xhr, status, error) {
              console.error(error);
          }
      });
    }

});

</script>

@endsection
