@extends('layouts/contentNavbarLayout')

@section('title', __('Categorys'))

@section('content')
<h4 class="py-3 mb-4" dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}"><span class="text-muted fw-light">{{ __('Pages') }} /</span> {{ __('Categorys') }}
</h4>

<!-- Responsive Table -->
<div class="card row" dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}">
  <h5 class="card-header">{{ __('Categorys') }}</h5>
  <div class="row">
    <input class="form-control my-w-fit-content mb-3 mx-1" type="search" placeholder="{{ __('Search ...') }}" id="dataTables_my_filter" />

    <select class="form-select text-center my-w-fit-content mb-3 mx-1" id="dataTables_my_length" aria-label="Default select example">
      <option value="10">10</option>
      <option value="25">25</option>
      <option value="50">50</option>
      <option value="100" selected>100</option>
    </select>

    <button type="button" class="btn btn-icon btn-outline-primary mb-3 mx-1" data-bs-toggle="modal" data-bs-target="#addCategory">
      <span class="tf-icons mdi mdi-plus-outline"></span>
    </button>

    <!-- Modal -->
    <div class="modal fade" id="addCategory" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}">
          <div class="modal-header">
            <h4 class="modal-title" id="modalCenterTitle">{{ __('Add Category') }}</h4>
          </div>
          <form id="addCategoryForm" method="POST" action="{{ route('category.create') }}">
            @csrf
            <div class="modal-body">
              <div class="row">
                <div class="col mb-4 mt-2">
                  <div class="form-floating form-floating-outline">
                    <input type="text" id="nameWithTitle" class="form-control" name="cname" placeholder="{{ __('Enter Category Name') }}">
                    <label for="nameWithTitle">{{ __('Name') }}</label>
                  </div>
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
    <table class="table table-striped w-100" id="categorys" data-page-length='100'>
      <thead>
        <tr class="text-nowrap">
          <th>#</th>
          <th>{{ __("Name") }}</th>
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

  .context-menu {
    position: absolute;
    background-color: #fff;
    border: 1px solid #ccc;
    padding: 5px 0;
    list-style: none;
    border-radius: 5px;
    z-index: 1000;
  }

  .context-menu li {
      padding: 5px 20px;
      cursor: pointer;
  }

  .context-menu li:hover {
      background-color: #f0f0f0;
  }

  .swal2-container.swal2-center.swal2-backdrop-show {
    z-index: 122222;
  }
</style>

<script src="{{ asset('assets/js/mine.js') }}"></script>

<script type="text/javascript">
  var table;
  var lang = "{{ app()->getLocale() }}";

      function editCategory(id) {
        console.log(id);
      }

  function deleteCategory(id) {
    Swal.fire({
        title: __("Do you really want to delete this Category?",lang),
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: __("Submit",lang),
        cancelButtonText: __("Cancel",lang),
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '/category/' + id,
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


      // Function to handle deleting a category
      function subcategorys(id) {
        window.location.href = "{{ url('category') }}/" + id + "/subcategorys";
      }

      function showContextMenu(id, x, y) {
        // Here you can define the content and behavior of the context menu
        var contextMenu = $('<ul class="context-menu" dir="{{ app()->isLocale("ar") ? "rtl" : "" }}"></ul>')
            .append('<li><a onclick="editCategory(' + id + ')"><i class="tf-icons mdi mdi-pencil-outline {{ app()->isLocale("ar") ? "ms-1" : "me-1" }}"></i>{{ __("Edit") }}</a></li>')
            .append('<li><a onclick="subcategorys(' + id + ')"><i class="tf-icons mdi mdi-format-list-numbered {{ app()->isLocale("ar") ? "ms-1" : "me-1" }}"></i>{{ __("SubCategorys") }}</a></li>')
            .append('<li class="px-0 pe-none"><div class="divider border-top my-0"></div></li>')
            .append('<li><a onclick="deleteCategory(' + id + ')"><i class="tf-icons mdi mdi-trash-can-outline {{ app()->isLocale("ar") ? "ms-1" : "me-1" }}"></i>{{ __("Delete") }}</a></li>');

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
      table = $('#categorys').DataTable({
          processing: true,
          serverSide: true,
          language: {
            "emptyTable": __("No data available in table",lang)
          },
          ajax: "{{ route('categorys') }}",
          columns: [
              {data: 'id', name: '#'},
              {data: 'name', name: '{{__("Name")}}'},
              {data: 'created_at', name: '{{__("Created At")}}'},
          ],


          rowCallback: function(row, data) {
              $(row).attr('id', 'category_' + data.id); // Assign an id to each row for easy targeting

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



      $('#addCategoryForm').submit(function(event) {
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
              confirmButtonText: __("Ok",lang),

            });
            table.ajax.reload();
          },
          error: function(xhr, textStatus, errorThrown) {
            const response = JSON.parse(xhr.responseText);
            Swal.fire({
              icon: response.icon,
              title: response.state,
              text: response.message
            });
          }
        });
      });


    });

</script>

@endsection
