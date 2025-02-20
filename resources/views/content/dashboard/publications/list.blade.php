@extends('layouts/contentNavbarLayout')

@section('title', __('Publications'))

@section('content')
<h4 class="py-3 mb-4" dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}"><span class="text-muted fw-light">{{ __('Pages') }} /</span> {{ __('Publications') }}
</h4>

<!-- Responsive Table -->
<div class="card row" dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}">
  <h5 class="card-header">{{__('Publications')}}</h5>
  <div class="row">
    <input class="form-control my-w-fit-content mb-3 mx-1" type="search" placeholder="{{ __('Search ...') }}" id="dataTables_my_filter" />

    <select class="form-select text-center my-w-fit-content mb-3 mx-1" id="dataTables_my_length" aria-label="Default select example">
      <option value="10">10</option>
      <option value="25">25</option>
      <option value="50">50</option>
      <option value="100" selected>100</option>
    </select>

    <a href="{{ route('publication.create.index') }}" class="btn btn-icon btn-outline-primary mb-3 mx-1">
      <span class="tf-icons mdi mdi-plus-outline"></span>
    </a>
  </div>

  <div class="table-responsive text-nowrap">
    <table class="table table-striped w-100" id="publications" data-page-length='100'>
      <thead>
        <tr class="text-nowrap">
          <th>#</th>
          <th>{{ __("Title") }}</th>
          <th>{{ __("Status") }}</th>
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



<script type="text/javascript">
  var table;
  var lang = "{{ app()->getLocale() }}";

  function editPublication(id) {
    window.location.href = ("{{ url('publication/') }}/" + id);
  }

  function demoPublication(id) {
    window.open("{{ url('view/publications') }}/" + id, "_blank");
  }

  function deletePublication(id) {
    Swal.fire({
        title: __("Do you really want to delete this Publication?",lang),
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: __("Submit",lang),
        cancelButtonText: __("Cancel",lang),
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '/publication/' + id,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    Swal.fire({
                        icon: response.icon,
                        title: response.state,
                        text: response.message,
                        confirmButtonText: __("Ok",lang),
                    });
                    table.ajax.reload();
                },
                error: function(xhr, textStatus, errorThrown) {
                    const response = JSON.parse(xhr.responseText);
                    Swal.fire({
                        icon: response.icon,
                        title: response.state,
                        text: response.message,
                        confirmButtonText: __("Ok",lang),
                    });
                }
            });
        }
    });
  }

      function showContextMenu(id, x, y) {
        // Here you can define the content and behavior of the context menu
        var contextMenu = $('<ul class="context-menu" dir="{{ app()->isLocale("ar") ? "rtl" : "" }}"></ul>')
            .append('<li><a onclick="editPublication(' + id + ')"><i class="tf-icons mdi mdi-pencil-outline {{ app()->isLocale("ar") ? "ms-1" : "me-1" }}"></i>{{ __("Edit") }}</a></li>')
            .append('<li><a onclick="demoPublication(' + id + ')"><i class="tf-icons mdi mdi-arrow-right-top {{ app()->isLocale("ar") ? "ms-1" : "me-1" }}"></i>{{ __("Demo") }}</a></li>')
            .append('<li class="px-0 pe-none"><div class="divider border-top my-0"></div></li>')
            .append('<li><a onclick="deletePublication(' + id + ')"><i class="tf-icons mdi mdi-trash-can-outline {{ app()->isLocale("ar") ? "ms-1" : "me-1" }}"></i>{{ __("Delete") }}</a></li>');

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
        table = $('#publications').DataTable({
          processing: true,
          serverSide: true,
          language: {
            "emptyTable": __("No data available in table",lang),
            "zeroRecords": __("No matching records found",lang)
          },
          ajax: "{{ route('publications') }}",
          columns: [
              {data: 'id', name: '#'},
              {data: 'title', name: '{{__("Title")}}'},
              {data: 'status', name: '{{__("Status")}}'},
              {data: 'created_at', name: '{{__("Created At")}}'},
          ],

          rowCallback: function(row, data) {
              $(row).attr('id', 'publication_' + data.id); // Assign an id to each row for easy targeting

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
        var nextButton = $('<li>').addClass('page-item').append($('<a>').addClass('page-link').attr('href', 'javascript:void(0);').html('&raquo;'));
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


    });

</script>

@endsection
