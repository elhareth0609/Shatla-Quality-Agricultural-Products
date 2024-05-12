{{-- @extends('content.home.app') --}}
@extends('layouts.homeLayout')

@section('title', '')

@section('content')
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-8 text-center my-w-fit-content">
      <h1 class="mb-4">{{ __('Plans') }}</h1>
      <div class="border-bottom border-dark"></div>
    </div>
  </div>

  <form class="my-5" id="addPlanForm" method="POST" action="{{ route('plan.add') }}">
    @csrf
    @foreach ($plans->chunk(2) as $chunk)
      <div class="row ">
        @foreach ($chunk as $plan)
          <div class="col-md-6"> <!-- Each plan takes half of the row -->
            <div class="card mb-3 plan-card" data-plan-id="{{ $plan->id }}">
              <div class="row g-0" dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}">
                <div class="col-md-4">
                  <input type="radio" class="form-check-input plan-checkbox" value="{{ $plan->id }}" name="plan" id="plan-{{ $plan->id }}" hidden>
                  <img class="card-img card-img-left" src="{{  $plan->photoUrl() }}" alt="Card image" />
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <h5 class="card-title">{{ $plan->name }}</h5>
                    <p class="card-text">{{ $plan->text }}</p>
                    <dive class="card-text d-flex justify-content-between">
                      <p class="m-0 my-w-fit-content">
                        @if(session('currency', config('currency.default_currency')) === 'DZ')
                            <small class="text-muted">{{ $plan->price }}</small>{{ config('currency.currencies.' . session('currency', config('currency.default_currency'))) }}
                        @else
                            {{ config('currency.currencies.' . session('currency', config('currency.default_currency'))) }}<small class="text-muted">{{ $plan->price }}</small>
                        @endif
                      </p>
                      <p class="m-0 my-w-fit-content">
                        @if(session('currency', config('currency.default_currency')) === 'DZ')
                        <del class="text-muted">{{ $plan->last_price }}</del>{{ config('currency.currencies.' . session('currency', config('currency.default_currency'))) }}
                        @else
                            {{ config('currency.currencies.' . session('currency', config('currency.default_currency'))) }}<del class="text-muted">{{ $plan->last_price }}</del>
                        @endif
                      </p>
                    </di>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @endforeach
    <div class="row justify-content-center">
      <button type="submit" class="btn btn-outline-secondary my-w-fit-content mt-3" id="submit-btn">
        <span class="tf-icons mdi mdi-checkbox-marked-circle-outline me-1" ></span>{{ __('Pay For Plan') }}
      </button>
    </div>
  </form>

</div>

<script>
var lang = "{{ app()->getLocale() }}";

$(document).ready(function() {
    const checkboxes = document.querySelectorAll('.plan-checkbox');
    const submitBtn = document.getElementById('submit-btn');

    const planCards = document.querySelectorAll('.plan-card');

    planCards.forEach(card => {
        card.addEventListener('click', function() {

            planCards.forEach(card => {
                card.classList.remove('border', 'border-2', 'border-primary');
            });

            card.classList.add('border', 'border-2', 'border-primary');

            const checkbox = card.querySelector('.plan-checkbox');

            checkbox.checked = !checkbox.checked;

            const anyChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);

            if(anyChecked) {
              submitBtn.classList.remove('btn-outline-secondary');
              submitBtn.classList.add('btn-outline-primary');
            } else {
              submitBtn.classList.remove('btn-outline-primary');
              submitBtn.classList.add('btn-outline-secondary');
            }

        });
    });


    $('#addPlanForm').submit(function(event) {
        event.preventDefault();

        var formData = $(this).serialize();
        var planValue = formData.split('&').find(item => item.startsWith('plan='));
        planValue = planValue ? planValue.split('=')[1] : ''; // Extract the plan value from formData

        if (!planValue) {
            Swal.fire({
                icon: 'warning',
                title: __("No Plan Selected",lang),
                text: __("Please select a plan before proceeding.",lang),
                confirmButtonText: __("Submit",lang),
            });
            return; // Exit the function if no plan is selected
        }

              Swal.fire({
                  title: __("Do you really want to Pay For This Plan?",lang),
                  icon: 'info',
                  showCancelButton: true,
                  confirmButtonText: __("Submit",lang),
                  cancelButtonText: __("Cancel",lang),
                  reverseButtons: true
              }).then((result) => {
                      $.ajax({
                          url: $(this).attr('action'),
                          type: $(this).attr('method'),
                          data: formData,
                          success: function(response, textStatus, xhr) {
                            window.location.href = response.url;
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
});

</script>

@endsection
