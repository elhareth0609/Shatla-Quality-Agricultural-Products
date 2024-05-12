{{-- @extends('content.home.app') --}}
@extends('layouts.homeLayout')

@section('title', '')

@section('content')
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-8 text-center my-w-fit-content">
      <h1 class="mb-4">{{ __('What do I plant?') }}</h1>
      <div class="border-bottom border-dark"></div>
    </div>
  </div>

      <div class="row mt-4">
          <div class="col-md-6"> <!-- Each plan takes half of the row -->
            <div class="card mb-3 plan-card" data-plan-id=" ">
              <div class="row g-0" dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}">
                <div class="col-md-4">
                  <input type="radio" class="form-check-input plan-checkbox" value=" " name="plan" id="plan- " hidden>
                  <img class="card-img card-img-left p-1" src="{{asset('assets/img/icons/seasons/3.png')}}" alt="Card image" />
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <h5 class="card-title">{{ __('Spring') }}</h5>
                    <p class="card-text">{{ __('Time: March 21 - June 20') }}</p>
                    <p class="card-text">   {{ __('It\'s a crucial time for planting a wide variety of crops, including vegetables, fruits, and flowers. Spring is known as the season of growth and renewal in agriculture, as farmers prepare their fields and orchards for the growing season ahead.') }}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6"> <!-- Each plan takes half of the row -->
            <div class="card mb-3 plan-card" data-plan-id=" ">
              <div class="row g-0" dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}">
                <div class="col-md-4">
                  <input type="radio" class="form-check-input plan-checkbox" value=" " name="plan" id="plan- " hidden>
                  <img class="card-img card-img-left p-1" src="{{asset('assets/img/icons/seasons/2.png')}}"alt="Card image" />
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <h5 class="card-title">{{ __('Winter') }}</h5>
                    <p class="card-text">{{ __('Time: December 21 - March 20') }}</p>
                    <p class="card-text">  {{ __('It\'s a time when many plants go dormant, and agricultural activity tends to slow down. However, certain crops like winter wheat, barley, and some vegetables thrive during this season.') }}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
      <div class="row">
        <div class="col-md-6"> <!-- Each plan takes half of the row -->
          <div class="card mb-3 plan-card" data-plan-id=" ">
            <div class="row g-0" dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}">
              <div class="col-md-4">
                <input type="radio" class="form-check-input plan-checkbox" value=" " name="plan" id="plan- " hidden>
                <img class="card-img card-img-left p-1" src="{{asset('assets/img/icons/seasons/1.png')}}" alt="Card image" />
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title">{{ __('Autumn') }}</h5>
                  <p class="card-text">{{ __('Time: September 23 - December 20') }}</p>
                  <p class="card-text">  {{ __('It\'s a critical time for harvesting many crops, including grains, apples, pumpkins, and root vegetables. Farmers also use this time to prepare their fields for the winter ahead, such as planting cover crops and applying compost.') }}</p>
              </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6"> <!-- Each plan takes half of the row -->
          <div class="card mb-3 plan-card" data-plan-id=" ">
            <div class="row g-0" dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}">
              <div class="col-md-4">
                <input type="radio" class="form-check-input plan-checkbox" value=" " name="plan" id="plan- " hidden>
                <img class="card-img card-img-left p-1" src="{{asset('assets/img/icons/seasons/4.png')}}" alt="Card image" />
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title">{{ __('Summer') }}</h5>
                  <Time: class="card-text">{{ __('Time: June 21 - September 22') }}</p>
                  <p class="card-text">  {{ __('It\'s the primary growing season for many crops, including corn, soybeans, fruits, and vegetables. Summer is also a time when farmers must manage irrigation, pest control, and weed suppression to ensure healthy crop development.') }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>

    {{-- <div class="row justify-content-center mb-4">
      <button type="submit" class="btn btn-outline-secondary my-w-fit-content mt-3" id="submit-btn">
        <span class="tf-icons mdi mdi-checkbox-marked-circle-outline me-1" ></span>{{ __('Go') }}
      </button>
    </div> --}}

</div>

{{-- <script>
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

</script> --}}

@endsection
