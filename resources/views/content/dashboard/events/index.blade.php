@extends('layouts/contentNavbarLayout')

@section('title', __('Events'))

@section('content')
<h4 class="py-3 mb-4" dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}"><span class="text-muted fw-light">{{ __('Pages') }} /</span> {{ __('Events') }}
</h4>

<div class="card row" dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}">
  <h5 class="card-header">{{ __('Events') }}</h5>
  {{-- calendar --}}
  <div id="calendar"></div>

  {{-- add Event Model --}}
  <div class="modal fade" id="addEvent" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}">
        <div class="modal-header">
          <h4 class="modal-title" id="modalCenterTitle">{{ __('Add Event') }}</h4>
        </div>
        <form id="addEventForm" method="POST" action="{{ route('events.create') }}">
          @csrf

          <div class="modal-body">

            <div class="row">
              <div class="col mb-4 mt-2">
                <div class="form-floating form-floating-outline">
                  <input type="text" class="form-control" name="title" placeholder="{{ __('Enter Title') }}">
                  <label for="title">{{ __('Title') }}</label>
                </div>
              </div>
            </div>

              <div class="row">
                <div class="col mb-4 mt-2">
                  <div class="form-floating form-floating-outline">
                    <input type="text" class="form-control" name="description" placeholder="{{ __('Enter Description') }}">
                    <label for="description">{{ __('Description') }}</label>
                  </div>
                </div>
              </div>

            <div class="row">
              <div class="col mb-4 mt-2">
                <div class="form-floating form-floating-outline">
                  <input class="form-control" type="datetime-local" name="start" />
                  <label for="end">{{ __('Start') }}</label>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col mb-4 mt-2">
                <div class="form-floating form-floating-outline">
                  <input class="form-control" type="datetime-local" name="end" />
                  <label for="end">{{ __('End') }}</label>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col mb-4 mt-2">
                <div class="form-floating form-floating-outline">
                  <input class="form-control" type="color" name="color" />
                  <label for="color">{{ __('Color') }}</label>
                </div>
              </div>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" id="hideMAEButton" data-bs-dismiss="modal">{{ __('Close') }}</button>
            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">{{ __('Save') }}</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  {{-- Edit Event Model --}}
  <div class="modal fade" id="updateEvent" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}">
        <div class="modal-header">
          <h4 class="modal-title" id="modalCenterTitle">{{ __('Update Event') }}</h4>
        </div>
        <form id="updateEventForm" method="POST" action="{{ route('events.update') }}">
          @csrf
          <input type="hidden" name="id" id="id" />
          <div class="modal-body">
            <div class="row">
              <div class="col mb-4 mt-2">
                <div class="form-floating form-floating-outline">
                  <input type="text" id="title" class="form-control" name="title" placeholder="{{ __('Enter Title') }}">
                  <label for="title">{{ __('Title') }}</label>
                </div>
              </div>
            </div>

              <div class="row">
                <div class="col mb-4 mt-2">
                  <div class="form-floating form-floating-outline">
                    <input type="text" id="description" class="form-control" name="description" placeholder="{{ __('Enter Description') }}">
                    <label for="description">{{ __('Description') }}</label>
                  </div>
                </div>
              </div>

            <div class="row">
              <div class="col mb-4 mt-2">
                <div class="form-floating form-floating-outline">
                  <input class="form-control" type="datetime-local" id="start" name="start" />
                  <label for="end">{{ __('Start') }}</label>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col mb-4 mt-2">
                <div class="form-floating form-floating-outline">
                  <input class="form-control" type="datetime-local" id="end" name="end" />
                  <label for="end">{{ __('End') }}</label>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col mb-4 mt-2">
                <div class="form-floating form-floating-outline">
                  <input class="form-control" type="color" name="color" id="color" />
                  <label for="color">{{ __('Color') }}</label>
                </div>
              </div>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" id="hideMUEButton" data-bs-dismiss="modal">{{ __('Close') }}</button>
            <button type="button" class="btn btn-outline-secondary" id="deleteEventButton" data-bs-dismiss="modal">{{ __('Delete') }}</button>
            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">{{ __('Save') }}</button>
          </div>
        </form>
      </div>
    </div>
  </div>

</div>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script type="text/javascript">
  var lang = "{{ app()->getLocale() }}";
  var calendarEl = document.getElementById('calendar');
  var eventsData = {!! json_encode($events) !!};

$(document).ready(function() {
  $.noConflict();

      var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          headerToolbar: {
            left: 'prev,next today add',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
          },
            events: eventsData,
            eventClick: function(info) {
              var event = info.event;
              var startStr = event.start.toISOString().slice(0, 16).replace('T', ' ');
              var endStr = event.end.toISOString().slice(0, 16).replace('T', ' ');
              $('#updateEvent #id').val(event.id);
              $('#updateEvent #title').val(event.title);
              $('#updateEvent #description').val(event.extendedProps.description);
              $('#updateEvent #start').val(startStr);
              $('#updateEvent #end').val(endStr);
              $('#updateEvent #color').val(event.backgroundColor);
              $('#updateEvent').modal('show');
            },
            customButtons: {
              add: {
                text: __("Add Event", lang),
                click: function() {
                  $('#addEvent').modal('show');
                },
              },
              today: {
                text: __("today", lang),
                click: function() {
                  calendar.gotoDate(new Date());
                },
              },
              dayGridMonth: {
                text: __("month", lang),
                click: function() {
                  calendar.changeView('dayGridMonth');
                },
              },
              timeGridWeek: {
                text: __("week", lang),
                click: function() {
                  calendar.changeView('timeGridWeek');
                },
              },
              timeGridDay: {
                text: __("day", lang),
                click: function() {
                  calendar.changeView('timeGridDay');
                },
              }
            }

      });

      calendar.render();

  $('#hideMUEButton').click(function() {
    $('#updateEvent').modal('hide');
  });

  $('#hideMAEButton').click(function() {
    $('#addEvent').modal('hide');
  });

  $('#addEventForm').submit(function(event) {
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
        }).then((result) => {
          if (result.isConfirmed) {
            $('#addEvent').modal('hide');
            calendar.addEvent({
                title: response.event.title,
                start: response.event.start,
                end: response.event.end,
                color: response.event.color
            }, true);
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
        }).then((result) => {
          if (result.isConfirmed) {
            $('#addEvent').modal('hide');
          }
        });
      }
    });
  });

  $('#updateEventForm').submit(function(event) {
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
        }).then((result) => {
          if (result.isConfirmed) {
            $('#updateEvent').modal('hide');
            var updatedEvent = calendar.getEventById(response.event.id);
                updatedEvent.setProp('title', $('#updateEvent #title').val()); // Update title
                updatedEvent.setExtendedProp('description', $('#updateEvent #description').val());
                updatedEvent.setStart($('#updateEvent #start').val());
                updatedEvent.setEnd($('#updateEvent #end').val());
                updatedEvent.setProp('backgroundColor', $('#updateEvent #color').val());
                updatedEvent.remove();
                calendar.addEvent(updatedEvent.toPlainObject());

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
        }).then((result) => {
          if (result.isConfirmed) {
            $('#updateEvent').modal('hide');
          }
        });
      }
    });
  });

  $('#deleteEventButton').click(function() {
    var id = $('#updateEvent #id').val();

    $.ajax({
      url: '/events/delete',
      type: 'DELETE',
      dataType: 'json',
      data: {
        id : id,
        _token : csrfToken
      },
      success: function(response) {
        Swal.fire({
          icon: response.icon,
          title: response.state,
          text: response.message,
          confirmButtonText: __("Ok",lang)
        }).then((result) => {
          if (result.isConfirmed) {
            $('#updateEvent').modal('hide');
            var updatedEvent = calendar.getEventById(response.event.id);
            updatedEvent.remove();
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
        }).then((result) => {
          if (result.isConfirmed) {
            $('#updateEvent').modal('hide');
          }
        });
      }
    });
  });

});


</script>

@endsection
