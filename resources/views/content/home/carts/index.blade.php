@extends('layouts.homeLayout')

@section('title', __('Cart'))

@section('content')

<div class="container-fluid pt-5">
  <div class="row px-xl-5">
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
                  <tr>
                      <td class="align-middle">
                        <img src="{{ asset('assets/home/images/products/clothes-2.jpg') }}" alt="" style="width: 50px;">
                      </td>
                      <td class="align-middle">
                        Colorful Stylish Shirt
                      </td>
                      @if(session('currency', config('currency.default_currency')) === 'DZ')
                          <td class="align-middle" dir="rtl">150{{ config('currency.currencies.' . session('currency', config('currency.default_currency'))) }}</td>
                      @else
                          <td class="align-middle">{{ config('currency.currencies.' . session('currency', config('currency.default_currency'))) }}150</td>
                      @endif
                      <td class="align-middle">
                        <div class="btn-group" role="group" aria-label="Second group">
                          <button type="button" class="btn btn-icon btn-primary">
                            <span class="tf-icons mdi mdi-plus"></span>
                          </button>
                          <input type="text" class="form-control text-center p-0 rounded-0 my-w-5" value="2">
                          <button type="button" class="btn btn-icon btn-primary">
                            <span class="tf-icons mdi mdi-minus"></span>
                          </button>
                        </div>
                      </td>
                      <td class="align-middle">$150</td>
                      <td class="align-middle">
                        <button type="button" class="btn btn-icon btn-outline-primary">
                          <span class="tf-icons mdi mdi-close"></span>
                        </button>
                      </td>
                  </tr>
              </tbody>
          </table>
      </div>
      <div class="col-lg-4">
          <form class="mb-5" action="">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Coupon Code" aria-label="Coupon Code" aria-describedby="button-addon2">
              <button class="btn btn-outline-primary" type="button" id="button-addon2">{{ __('Apply') }}</button>
            </div>
          </form>
          <div class="card border-secondary mb-5">
              <div class="card-header bg-primary border-0">
                  <h4 class="font-weight-semi-bold m-0 text-white">{{ __('Cart Summary') }}</h4>
              </div>
              <div class="card-body">
                  <div class="d-flex justify-content-between mb-3 pt-1">
                      <h6 class="font-weight-medium">{{ __('Subtotal') }}</h6>
                      <h6 class="font-weight-medium">$150</h6>
                  </div>
                  <div class="d-flex justify-content-between mb-3">
                      <h6 class="font-weight-medium">{{ __('Shipping') }}</h6>
                      <h6 class="font-weight-medium">$10</h6>
                  </div>
                  <div class="d-flex justify-content-between">
                    <h6 class="font-weight-medium">{{ __('Coupon') }}</h6>
                    <h6 class="font-weight-medium">0%</h6>
                  </div>
              </div>
              <div class="card-footer border-secondary bg-transparent">
                  <div class="d-flex justify-content-between mt-2">
                      <h5 class="font-weight-bold">{{ __('Total') }}</h5>
                      <h5 class="font-weight-bold">$160</h5>
                  </div>
                  <a class="btn btn-primary float-end" href="{{ route('cart.checkout') }}">{{ __('Checkout') }}</a>
              </div>
          </div>
      </div>
  </div>
</div>

@endsection
