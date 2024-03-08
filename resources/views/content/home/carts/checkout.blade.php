@extends('layouts.homeLayout')

@section('title', 'Check Out')

@section('content')
<div class="container-fluid pt-5">
  <div class="row px-xl-5">
      <div class="col-lg-8">
          <div class="mb-4">
              <h4 class="font-weight-semi-bold mb-4">Billing Address</h4>
              <div class="row">
                  <div class="col-md-6 form-group">
                    <div class="form-floating form-floating-outline mb-4">
                      <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" />
                      <label for="exampleFormControlInput1">{{ __('First Name') }}</label>
                    </div>                  </div>
                  <div class="col-md-6">
                    <div class="form-floating form-floating-outline mb-4">
                      <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" />
                      <label for="exampleFormControlInput1">{{ __('Last Name') }}</label>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-floating form-floating-outline mb-4">
                      <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" />
                      <label for="exampleFormControlInput1">{{ __('Email address') }}</label>
                    </div>
                  </div>
                  <div class="col-md-6 form-group">
                    <div class="form-floating form-floating-outline mb-4">
                      <input class="form-control" type="tel" placeholder="90-(164)-188-556" id="html5-tel-input" />
                      <label for="html5-tel-input">{{ __('Phone') }}</label>
                    </div>
                  </div>
                  <div class="col-md-6 form-group">
                      <label>Address Line 1</label>
                      <input class="form-control" type="text" placeholder="123 Street">
                  </div>
                  <div class="col-md-6 form-group">
                      <label>Address Line 2</label>
                      <input class="form-control" type="text" placeholder="123 Street">
                  </div>
                  <div class="col-md-6 form-group">
                      <label>Country</label>
                      <select class="custom-select">
                          <option selected>United States</option>
                          <option>Afghanistan</option>
                          <option>Albania</option>
                          <option>Algeria</option>
                      </select>
                  </div>
                  <div class="col-md-6 form-group">
                      <label>City</label>
                      <input class="form-control" type="text" placeholder="New York">
                  </div>
                  <div class="col-md-6 form-group">
                      <label>State</label>
                      <input class="form-control" type="text" placeholder="New York">
                  </div>
                  <div class="col-md-6 form-group">
                      <label>ZIP Code</label>
                      <input class="form-control" type="text" placeholder="123">
                  </div>
                  <div class="col-md-12 form-group">
                      <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" id="newaccount">
                          <label class="custom-control-label" for="newaccount">Create an account</label>
                      </div>
                  </div>
                  <div class="col-md-12 form-group">
                      <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" id="shipto">
                          <label class="custom-control-label" for="shipto"  data-toggle="collapse" data-target="#shipping-address">Ship to different address</label>
                      </div>
                  </div>
              </div>
          </div>
          <div class="collapse mb-4" id="shipping-address">
              <h4 class="font-weight-semi-bold mb-4">Shipping Address</h4>
              <div class="row">
                  <div class="col-md-6 form-group">
                      <label>First Name</label>
                      <input class="form-control" type="text" placeholder="John">
                  </div>
                  <div class="col-md-6 form-group">
                      <label>Last Name</label>
                      <input class="form-control" type="text" placeholder="Doe">
                  </div>
                  <div class="col-md-6 form-group">
                      <label>E-mail</label>
                      <input class="form-control" type="text" placeholder="example@email.com">
                  </div>
                  <div class="col-md-6 form-group">
                      <label>Mobile No</label>
                      <input class="form-control" type="text" placeholder="+123 456 789">
                  </div>
                  <div class="col-md-6 form-group">
                      <label>Address Line 1</label>
                      <input class="form-control" type="text" placeholder="123 Street">
                  </div>
                  <div class="col-md-6 form-group">
                      <label>Address Line 2</label>
                      <input class="form-control" type="text" placeholder="123 Street">
                  </div>
                  <div class="col-md-6 form-group">
                      <label>Country</label>
                      <select class="custom-select">
                          <option selected>United States</option>
                          <option>Afghanistan</option>
                          <option>Albania</option>
                          <option>Algeria</option>
                      </select>
                  </div>
                  <div class="col-md-6 form-group">
                      <label>City</label>
                      <input class="form-control" type="text" placeholder="New York">
                  </div>
                  <div class="col-md-6 form-group">
                      <label>State</label>
                      <input class="form-control" type="text" placeholder="New York">
                  </div>
                  <div class="col-md-6 form-group">
                      <label>ZIP Code</label>
                      <input class="form-control" type="text" placeholder="123">
                  </div>
              </div>
          </div>
      </div>
      <div class="col-lg-4">
          <div class="card border-secondary mb-5">
              <div class="card-header border-0 bg-primary">
                  <h4 class="font-weight-semi-bold m-0">Order Total</h4>
              </div>
              <div class="card-body">
                  <h5 class="font-weight-medium mb-3">Products</h5>
                  <div class="d-flex justify-content-between">
                      <p>Colorful Stylish Shirt 1</p>
                      <p>$150</p>
                  </div>
                  <div class="d-flex justify-content-between">
                      <p>Colorful Stylish Shirt 2</p>
                      <p>$150</p>
                  </div>
                  <div class="d-flex justify-content-between">
                      <p>Colorful Stylish Shirt 3</p>
                      <p>$150</p>
                  </div>
                  <hr class="mt-0">
                  <div class="d-flex justify-content-between mb-3 pt-1">
                      <h6 class="font-weight-medium">Subtotal</h6>
                      <h6 class="font-weight-medium">$150</h6>
                  </div>
                  <div class="d-flex justify-content-between mb-3">
                    <h6 class="font-weight-medium">Shipping</h6>
                    <h6 class="font-weight-medium">$10</h6>
                  </div>
                  <div class="d-flex justify-content-between">
                    <h6 class="font-weight-medium">Coupon</h6>
                    <h6 class="font-weight-medium">0%</h6>
                  </div>
                  <hr class="mt-0">

              </div>
              <div class="card-footer border-secondary bg-transparent">
                  <div class="d-flex justify-content-between mt-2">
                      <h5 class="font-weight-bold">Total</h5>
                      <h5 class="font-weight-bold">$160</h5>
                  </div>
              </div>
          </div>
          <div class="card border-secondary mb-5">
              <div class="card-header border-0 bg-primary">
                  <h4 class="font-weight-semi-bold m-0">Payment</h4>
              </div>
              <div class="card-body">
                <div class="form-check mt-3">
                  <input class="form-check-input" name="payment-way" type="radio" value="" id="upon-receipt" />
                  <label class="form-check-label" for="defaultCheck1">
                    {{ __('Upon receipt') }}
                  </label>
                </div>
                <div class="form-check mt-3">
                  <input class="form-check-input" name="payment-way" type="radio" value="" id="gold-card" />
                  <label class="form-check-label" for="defaultCheck1">
                    {{ __('Gold card') }}
                  </label>
                </div>
                <div class="form-check mt-3">
                  <input class="form-check-input" name="payment-way" type="radio" value="" id="baridi-mob" />
                  <label class="form-check-label" for="defaultCheck1">
                    {{ __('Baridi Mob') }}
                  </label>
                </div>
              </div>
              <div class="card-footer border-secondary bg-transparent">
                  <button class="btn btn-primary float-end">Place Order</button>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection
