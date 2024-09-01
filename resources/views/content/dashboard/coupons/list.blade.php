@extends('layouts/contentNavbarLayout')

@section('title', __('Coupons'))

@section('content')
<h4 class="py-3 mb-4" dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}"><span class="text-muted fw-light">{{ __('Pages') }} /</span> {{ __('Coupons') }}
</h4>

<!-- Responsive Table -->
<div class="card row" dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}">
  <h5 class="card-header">{{ __('Coupons') }}</h5>
  <div class="row">
      <input class="form-control my-w-fit-content mb-3 mx-1" type="search" placeholder="{{ __('Search ...') }}" id="dataTables_my_filter" />

      <select class="form-select text-center my-w-fit-content mb-3 mx-1" id="dataTables_my_length" aria-label="Default select example">
        <option value="10">10</option>
        <option value="25">25</option>
        <option value="50">50</option>
        <option value="100" selected>100</option>
      </select>

      <button type="button" class="btn btn-icon btn-outline-primary mb-3 mx-1" data-bs-toggle="modal" data-bs-target="#addCoupon">
        <span class="tf-icons mdi mdi-plus-outline"></span>
      </button>

      <!-- Modal -->
      <div class="modal fade" id="addCoupon" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content" dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}">
            <div class="modal-header">
              <h4 class="modal-title" id="modalCenterTitle">{{ __('Add Coupon') }}</h4>
            </div>
            <form id="addCouponForm" method="POST" action="{{ route('coupon.create') }}">
              @csrf
              <div class="modal-body">
                <div class="row">
                  <div class="col mb-4 mt-2">
                    <div class="form-floating form-floating-outline">
                      <input type="text" id="nameWithTitle" class="form-control" name="code" placeholder="{{ __('Enter Code') }}">
                      <label for="nameWithTitle">{{ __('Code') }}</label>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col mb-4 mt-2">
                    <div class="input-group" dir="ltr">
                      <span class="input-group-text">{{ __('Max Uses') }}</span>
                      <input type="number" class="form-control" placeholder="{{ __('Max Uses') }}" min="1" name="max" aria-label="Discount (to the nearest dollar)" />
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col mb-4 mt-2">
                    <div class="input-group" dir="ltr">
                      <input type="number" class="form-control" placeholder="{{ __('Discount') }}" min="1" max="100" name="discount" aria-label="Discount (to the nearest dollar)" />
                      <span class="input-group-text">%</span>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col mb-4 mt-2">
                    <div class="form-floating form-floating-outline">
                      <input class="form-control" type="datetime-local" id="html5-datetime-local-input" name="expired_date" />
                      <label for="html5-datetime-local-input">{{ __('Expired At') }}</label>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col mb-4 mt-2">
                    <select id="largeSelect" class="form-select form-select-lg" name="status">
                      <option value="inactive" selected>{{ __('In Active') }}</option>
                      <option value="active">{{ __('Active') }}</option>
                    </select>
                  </div>
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">{{ __('Save') }}</button>
              </div>
            </form>
          </div>
        </div>
      </div>


  </div>
  <div class="table-responsive text-nowrap">
    <table class="table table-striped w-100" id="coupons" data-page-length='100'>
      <thead>
        <tr class="text-nowrap">
          <th>#</th>
          <th>{{ __("Code") }}</th>
          <th>{{ __("Discount") }}</th>
          <th>{{ __("Max") }}</th>
          <th>{{ __("Status") }}</th>
          <th>{{ __("Expired At") }}</th>
          <th>{{ __("Created At") }}</th>
        </tr>
      </thead>
    </table>
  </div>
      <div class="row justify-content-between align-items-baseline">
        <!-- Show 5 from 100 -->
        <div class="my-w-fit-content mt-3" id="dataTables_my_info">
        </div>
        <!--/ Show 5 from 100 -->
          <!-- Outline rounded Pagination -->
        <nav class="my-w-fit-content mt-3" aria-label="Page navigation">
          <ul class="pagination pagination-rounded pagination-outline-primary" id="dataTables_my_paginate">
          </ul>
        </nav>
          <!--/ Outline rounded Pagination -->
      </div>

</div>
<!--/ Responsive Table -->

<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

<script type="text/javascript">
  var table;
  var lang = "{{ app()->getLocale() }}";

  Pusher.logToConsole = true;

  var pusher = new Pusher('f513c6dba43174cbee4d', {
    cluster: 'eu'
  });

      function editCoupon(id) {
        console.log(id);
      }

  function deleteCoupon(id) {
    Swal.fire({
        title: __("Do you really want to delete this Coupon?",lang),
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: __("Submit",lang),
        cancelButtonText: __("Cancel",lang),
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '/coupon/' + id,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
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
        }
    });
  }

      function showContextMenu(id, x, y) {

        var contextMenu = $('<ul class="context-menu" dir="{{ app()->isLocale("ar") ? "rtl" : "" }}"></ul>')
            .append('<li><a onclick="editCoupon(' + id + ')"><i class="tf-icons mdi mdi-pencil-outline {{ app()->isLocale("ar") ? "ms-1" : "me-1" }}"></i>{{ __("Edit") }}</a></li>')
            .append('<li class="px-0 pe-none"><div class="divider border-top my-0"></div></li>')
            .append('<li><a onclick="deleteCoupon(' + id + ')"><i class="tf-icons mdi mdi-trash-can-outline {{ app()->isLocale("ar") ? "ms-1" : "me-1" }}"></i>{{ __("Delete") }}</a></li>');


        contextMenu.css({
            top: y,
            left: x
        });


        $('body').append(contextMenu);


        $(document).on('click', function() {
          $('.context-menu').remove();
        });
      }

$(document).ready(function() {
  $.noConflict();
      var lang = "{{ app()->getLocale() }}";
      var table = $('#coupons').DataTable({
          processing: true,
          serverSide: true,
          language: {
            "emptyTable": __("No data available in table",lang),
            "zeroRecords": __("No matching records found",lang)
          },
          ajax: "{{ route('coupons') }}",
          columns: [
              {data: 'id', name: '#'},
              {data: 'code', name: '{{__("Code")}}'},
              {data: 'discount', name: '{{__("Discount")}}'},
              {data: 'max', name: '{{__("Max")}}'},
              {data: 'status', name: '{{__("Status")}}'},
              {data: 'expired_date', name: '{{__("Expired At")}}'},
              {data: 'created_at', name: '{{__("Created At")}}'},
          ],
          rowCallback: function(row, data) {
              $(row).attr('id', 'coupon_' + data.id);


              $(row).on('contextmenu', function(e) {
                  e.preventDefault();
                  showContextMenu(data.id, e.pageX, e.pageY);
              });
          }
      });

      $('#dataTables_my_length').change(function() {
        var selectedValue = $(this).val();
        table.page.len(selectedValue).draw();
      });

      $('#dataTables_my_filter').on('input', function () {
        var query = $(this).val();
        table.search(query).draw();
      });

      table.on('draw', function () {
        var info = table.page.info();
        var pagination = $('#dataTables_my_paginate');

        pagination.empty();


        var prevButton = $('<li>').addClass('page-item').append($('<a>').addClass('page-link ms-1').attr('href', 'javascript:void(0);').html('&laquo;'));
        if (info.page > 0) {
          prevButton.find('a').click(function () {
            table.page('previous').draw('page');
          });
        } else {
          prevButton.addClass('disabled');
        }
        pagination.append(prevButton);


        for (var i = 0; i < info.pages; i++) {
          var page = i + 1;
          var liClass = (page === info.page + 1) ? 'active' : 'd-none';
          var link = $('<a>').addClass('page-link').attr('href', 'javascript:void(0);').text(page);
          var listItem = $('<li>').addClass('page-item').addClass(liClass).append(link);
          listItem.click((function (pageNumber) {
            return function () {
              table.page(pageNumber).draw('page');
            };
          })(i));
          pagination.append(listItem);
        }


        var nextButton = $('<li>').addClass('page-item').append($('<a>').addClass('page-link ms-1').attr('href', 'javascript:void(0);').html('&raquo;'));
        if (info.page < info.pages - 1) {
          nextButton.find('a').click(function () {
            table.page('next').draw('page');
          });
        } else {
          nextButton.addClass('disabled');
        }
        pagination.append(nextButton);


        var startRange = info.start + 1;
        var endRange = info.start + info.length;
        var pageInfo = startRange + ' ' + __("to",lang) + ' ' + endRange + ' ' + __("from",lang) + ' ' + info.recordsTotal;
        $('#dataTables_my_info').text(pageInfo);

      });



      $('#addCouponForm').submit(function(event) {
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
            table.ajax.reload();
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

      var channel = pusher.subscribe('coupons');
      channel.bind('couponsEdited', function(data) {
        table.ajax.reload();
      });
    });

</script>

@endsection
