@extends('layouts/contentNavbarLayout')

@section('title', __('Events'))

@section('content')
<h4 class="py-3 mb-4" dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}"><span class="text-muted fw-light">{{ __('Pages') }} /</span> {{ __('Events') }}
</h4>

<!-- Responsive Table -->
<div class="card row" dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}">
  <h5 class="card-header">{{ __('Events') }}</h5>

</div>
<!--/ Responsive Table -->

<style>
  .dataTables_length,
  .dataTables_filter,
  .dataTables_info,
  .dataTables_paginate {
    display: none;
  }
  td,tr {
    text-align: center;
  }

</style>

<script src="{{ asset('assets/js/mine.js') }}"></script>

<script type="text/javascript">
  var table;
  var lang = "{{ app()->getLocale() }}";

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
        }
    });
  }

      function showContextMenu(id, x, y) {
        // Here you can define the content and behavior of the context menu
        var contextMenu = $('<ul class="context-menu" dir="{{ app()->isLocale("ar") ? "rtl" : "" }}"></ul>')
            .append('<li><a onclick="editCoupon(' + id + ')">{{ __("Edit") }}</a></li>')
            .append('<li><a onclick="deleteCoupon(' + id + ')">{{ __("Delete") }}</a></li>');

        // Position the context menu at the mouse coordinates
        contextMenu.css({
            top: y,
            left: x
        });

        // Append the context menu to the body
        $('body').append(contextMenu);

        // Hide the context menu when clicking outside of it
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
            "emptyTable": __("No data available in table",lang)
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
              $(row).attr('id', 'coupon_' + data.id); // Assign an id to each row for easy targeting

              // Add right-click context menu listener to each row
              $(row).on('contextmenu', function(e) {
                  e.preventDefault();
                  showContextMenu(data.id, e.pageX, e.pageY); // Show context menu at mouse position
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

        // Add Previous button
        var prevButton = $('<li>').addClass('page-item').append($('<a>').addClass('page-link ms-1').attr('href', 'javascript:void(0);').html('&laquo;'));
        if (info.page > 0) {
          prevButton.find('a').click(function () {
            table.page('previous').draw('page');
          });
        } else {
          prevButton.addClass('disabled');
        }
        pagination.append(prevButton);

        // Add page links
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

        // Add Next button
        var nextButton = $('<li>').addClass('page-item').append($('<a>').addClass('page-link ms-1').attr('href', 'javascript:void(0);').html('&raquo;'));
        if (info.page < info.pages - 1) {
          nextButton.find('a').click(function () {
            table.page('next').draw('page');
          });
        } else {
          nextButton.addClass('disabled');
        }
        pagination.append(nextButton);

            // Calculate the range
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

    });

</script>

@endsection
