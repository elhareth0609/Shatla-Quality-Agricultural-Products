@extends('layouts/contentNavbarLayout')

@section('title', __('Products'))

@section('content')
<h4 class="py-3 mb-4" dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}"><span class="text-muted fw-light">{{ __('Pages') }} /</span> {{ __('Products') }}
</h4>

<!-- Responsive Table -->
<div class="card row" dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}">
  <h5 class="card-header">{{__('Products')}}</h5>
  <div class="row">
    <input class="form-control my-w-fit-content mb-3 mx-1" type="search" placeholder="{{ __('Search ...') }}" id="dataTables_my_filter" />

    <select class="form-select text-end my-w-fit-content mb-3 mx-1" id="dataTables_my_length" aria-label="Default select example">
      <option value="10">10</option>
      <option value="25">25</option>
      <option value="50">50</option>
      <option value="100" selected>100</option>
    </select>

    <select class="form-select text-end my-w-fit-content mb-3 mx-1" id="selectCategory" name="category_id" aria-label="Default select example">
      <option value="0" selected>0</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
    </select>

    <a href="{{ route('product.create.index') }}" class="btn btn-icon btn-outline-primary mb-3 mx-1">
      <span class="tf-icons mdi mdi-plus-outline"></span>
    </a>
</div>

  <div class="table-responsive text-nowrap">
    <table class="table table-striped w-100" id="products" data-page-length='100'>
      <thead>
        <tr class="text-nowrap">
          <th>#</th>
          <th>{{ __("Name") }}</th>
          <th>{{ __("Category") }}</th>
          <th>{{ __("Status") }}</th>
          <th>{{ __("Price") }}</th>
          {{-- <th>{{ __("Amount Price") }}</th> --}}
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


<script src="{{ asset('assets/js/mine.js') }}"></script>

<script type="text/javascript">
      var lang = "{{ app()->getLocale() }}";
      var table;

      function editProduct(id) {
        window.location.href = ("{{ url('product/') }}/" + id);
      }

      function demoProduct(id) {
        window.open("{{ url('view/product') }}/" + id, "_blank");
      }

      function deleteProduct(id) {
        Swal.fire({
            title: __("Do you really want to delete this Product?",lang),
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: __("Submit",lang),
            cancelButtonText: __("Cancel",lang),
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/product/' + id,
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
            .append('<li><a onclick="editProduct(' + id + ')"><i class="tf-icons mdi mdi-pencil-outline {{ app()->isLocale("ar") ? "ms-1" : "me-1" }}"></i>{{ __("Edit") }}</a></li>')
            .append('<li><a onclick="demoProduct(' + id + ')"><i class="tf-icons mdi mdi-arrow-right-top {{ app()->isLocale("ar") ? "ms-1" : "me-1" }}"></i>{{ __("Demo") }}</a></li>')
            .append('<li class="px-0 pe-none"><div class="divider border-top my-0"></div></li>')
            .append('<li><a onclick="deleteProduct(' + id + ')"><i class="tf-icons mdi mdi-trash-can-outline {{ app()->isLocale("ar") ? "ms-1" : "me-1" }}"></i>{{ __("Delete") }}</a></li>');

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
        table = $('#products').DataTable({
          processing: true,
          serverSide: true,
          language: {
            "emptyTable": __("No data available in table",lang),
            "zeroRecords": __("No matching records found",lang)
          },
          ajax: {
            url: "{{ route('products') }}",
            data: function(d) {
                d.category_id = $('#selectCategory').val(); // Send selected category
            }
          },
          columns: [
              {data: 'id', name: '#'},
              {data: 'name', name: '{{__("Name")}}'},
              {data: 'subcategory_id', name: '{{__("Category")}}'},
              {data: 'status', name: '{{__("Status")}}'},
              {data: 'price', name: '{{__("Price")}}'},
              {data: 'created_at', name: '{{__("Created At")}}'},
          ],
          rowCallback: function(row, data) {
              $(row).attr('id', 'category_' + data.id); // Assign an id to each row for easy targeting

              // Add right-click context menu listener to each row
              $(row).on('contextmenu', function(e) {
                  e.preventDefault();
                  showContextMenu(data.id, e.pageX, e.pageY); // Show context menu at mouse position
              });

              $(row).find('td').eq(1).on('dblclick', function() {
                  var cell = $(this);
                  var originalValue = cell.text();
                  var input = $('<input>', {
                      type: 'text',
                      value: originalValue,
                      class: 'form-control',
                      'data-id': data.id
                  }).css('width', '100%');

                  cell.html(input);

                  input.focus();

                  // Handle Enter key or focus loss
                  input.on('keypress blur', function(e) {
                      if (e.type === 'keypress' && e.which !== 13) {
                          return;
                      }

                      var newValue = $(this).val();

                      // Only proceed if the value has changed
                      if (newValue !== originalValue) {
                          $.ajax({
                              url: '/product/' + data.id + '/update/name',  // Update with your actual route
                              type: 'POST',
                              headers: {
                                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                              },
                              data: { name: newValue },
                              success: function(response) {
                                  cell.text(newValue);
                                  // show badge success message
                                  // Swal.fire({
                                  //     icon: response.icon,
                                  //     title: response.state,
                                  //     text: response.message,
                                  //     confirmButtonText: __("Ok", lang),
                                  // });
                              },
                              error: function(xhr) {
                                  // show badge error message
                                  const response = JSON.parse(xhr.responseText);
                                  // Swal.fire({
                                  //     icon: response.icon,
                                  //     title: response.state,
                                  //     text: response.message,
                                  //     confirmButtonText: __("Ok", lang),
                                  // });
                                  cell.text(originalValue); // revert back on error
                              }
                          });
                      } else {
                          cell.text(originalValue);
                      }
                  });
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

      $('#selectCategory').change(function() {
        table.ajax.reload();
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
