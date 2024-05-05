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
                  <input type="checkbox" class="form-check-input plan-checkbox" name="plan-{{ $plan->id }}" id="plan-{{ $plan->id }}" hidden>
                  <img class="card-img card-img-left" src="{{  $plan->photoUrl() }}" alt="Card image" />
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <h5 class="card-title">{{ $plan->name }}</h5>
                    <p class="card-text">{{ $plan->text }}</p>
                    <p class="card-text"><small class="text-muted">{{ $plan->price }}   {{ $plan->last_price }}</small></p>
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


<style>
  /* .plan-card {
    border-radius: 0.5rem;
    border: 2px solid #b5bfd9;
    transition: 0.15s ease;
    cursor: pointer;
  }

  .plan-card:before {
		content: "";
		position: absolute;
		display: block;
		width: 1.25rem;
		height: 1.25rem;
		border: 2px solid #b5bfd9;
		background-color: #fff;
		border-radius: 50%;
		top: 0.25rem;
		left: 0.25rem;
		opacity: 0;
		transform: scale(0);
		transition: 0.25s ease;
		background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='192' height='192' fill='%23FFFFFF' viewBox='0 0 256 256'%3E%3Crect width='256' height='256' fill='none'%3E%3C/rect%3E%3Cpolyline points='216 72.005 104 184 48 128.005' fill='none' stroke='%23FFFFFF' stroke-linecap='round' stroke-linejoin='round' stroke-width='32'%3E%3C/polyline%3E%3C/svg%3E");
    background-size: 12px;
		background-repeat: no-repeat;
		background-position: 50% 50%;
	}

  /* Apply primary border when radio button is checked */
  /* .plan-checkbox:checked + .plan-card {
      border-color: #216ee0;
  } */ */

  /* .plan-card:hover {
    border: 2px solid #2260ff;
} */


</style>
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
});

</script>

@endsection
