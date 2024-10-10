@extends('layouts/contentNavbarLayout')

@section('title', __('Chat'))

@section('content')
<h4 class="py-3 mb-4" dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}">
    <span class="text-muted fw-light">{{ __('Pages') }} /</span> {{ __('Chat') }}
</h4>

<!-- Map and Accordion -->
<div class="row">
    <div class="col-md-8">
        <div id="map" style="height: 500px;"></div>
    </div>
    <div class="col-md-4">
        <div class="accordion" id="carList">
            @foreach($cars as $car)
                <div class="accordion-item" id="car-{{ $car->id }}">
                    <h2 class="accordion-header" id="heading-{{ $car->id }}">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $car->id }}" aria-expanded="true" aria-controls="collapse-{{ $car->id }}">
                            {{ $car->name }}
                        </button>
                    </h2>
                    <div id="collapse-{{ $car->id }}" class="accordion-collapse collapse" aria-labelledby="heading-{{ $car->id }}" data-bs-parent="#carList">
                        <div class="accordion-body">
                            <button class="btn btn-primary btn-track" data-car-id="{{ $car->id }}">{{ __('Track Route') }}</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDma6ZyUMlelRvLppe6mLWTnHPakqCm6TY&callback=initMap&language={{ app()->getLocale() }}" async defer></script>
<script type="text/javascript">
  let map;
  let markers = {};
  let activeMarker = null;

  function initMap() {
      map = new google.maps.Map(document.getElementById("map"), {
          zoom: 12,
          center: { lat: 33.367522, lng: 6.851726 },
      });

      updateMapAndList();
      setInterval(updateMapAndList, 5000);
  }

  function updateMapAndList() {
      $.getJSON('{{ route('map.locations') }}', function(data) {
          data.forEach(location => {
              let latLng = new google.maps.LatLng(location.late, location.long);
              if (!markers[location.car.id] || markers[location.car.id].getPosition().lat() !== latLng.lat() || markers[location.car.id].getPosition().lng() !== latLng.lng()) {
                  if (markers[location.car.id]) {
                      markers[location.car.id].setMap(null);
                  }

                  let iconUrl = location.active
                      ? 'http://127.0.0.1:8000/assets/home/icons/car-2.png'
                      : 'http://127.0.0.1:8000/assets/home/icons/car-1.png';

                      let marker = new google.maps.Marker({
                        position: latLng,
                        map: map,
                        label: {
                            text: location.car.name,
                            className: 'map-label'
                        },
                        icon: {
                            url: iconUrl,
                            scaledSize: new google.maps.Size(20, 52) // Adjust the size as needed
                        }
                    });


                  marker.addListener('click', function() {
                      setActiveAccordionItem(location.car.id);
                  });

                  markers[location.car.id] = marker;
              }
          });
      });
  }

  function setActiveAccordionItem(carId) {
      // Collapse all accordion items first
      $('.accordion-item').removeClass('active');
      $('.accordion-collapse').collapse('hide');

      // Expand the clicked item's accordion
      let accordionItem = $('#car-' + carId);
      accordionItem.addClass('active');
      accordionItem.find('.accordion-collapse').collapse('show');

      // Center the map on the selected marker and zoom in
      if (markers[carId]) {
          map.panTo(markers[carId].getPosition());
          map.setZoom(15); // Zoom level to focus on the selected car
      }

      // Change the marker icon
      if (activeMarker) {
        activeMarker.setIcon({
              url: 'http://127.0.0.1:8000/assets/home/icons/car-1.png',
              scaledSize: new google.maps.Size(20, 52)
          });
      }
      markers[carId].setIcon({
              url: 'http://127.0.0.1:8000/assets/home/icons/car-2.png',
              scaledSize: new google.maps.Size(20, 52)
      });
      activeMarker = markers[carId];
  }


  $(document).ready(function() {
      $('.btn-track').on('click', function() {
          let carId = $(this).data('car-id');
          // Handle tracking logic here
      });

      $('#carList').on('click', '.accordion-item', function() {
          let carId = $(this).attr('id').replace('car-', '');
          setActiveAccordionItem(carId);
      });
  });

</script>

@endsection
