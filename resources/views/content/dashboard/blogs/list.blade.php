@extends('layouts/contentNavbarLayout')

@section('title', 'Blogs')

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">{{__('Pages')}} /</span> {{__('Blogs')}}
</h4>

<!-- Responsive Table -->
<div class="card row">
  <h5 class="card-header">{{__('Blogs')}}</h5>
  <div class="row mb-3 justify-content-between">
    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-3 col-3" >
      <select class="form-select text-center h-100" id="dataTables_my_length" aria-label="Default select example">
        <option value="10">10</option>
        <option value="25">25</option>
        <option value="50">50</option>
        <option value="100" selected>100</option>
      </select>
    </div>
    <div class="form-floating form-floating-outline col-xl-3 col-lg-3 col-md-3 col-sm-4 col-3">
      <input class="form-control" type="search" placeholder="Search ..." id="dataTables_my_filter" />
      <label for="html5-search-input">Search</label>
    </div>
  </div>
  <div class="table-responsive text-nowrap">
    <table class="table table-striped w-100" id="blogs" data-page-length='100'>
      <thead>
        <tr class="text-nowrap">
          <th>#</th>
          <th>{{ __("Name") }}</th>
          <th>{{ __("Image") }}</th>
          <th>{{ __("Category") }}</th>
          <th>{{ __("Created At") }}</th>
          <th>{{ __("Action") }}</th>
        </tr>
      </thead>
    </table>
  </div>
      <div class="row justify-content-between align-items-baseline mt-3">
        <!-- Show 5 from 100 -->
        <div class="col-6" id="dataTables_my_info">
        </div>
        <!--/ Show 5 from 100 -->
          <!-- Outline rounded Pagination -->
        <nav class="col-6 d-flex justify-content-end" aria-label="Page navigation">
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
</style>

<script type="text/javascript">
    $(document).ready(function() {
      $.noConflict();
      var table = $('#blogs').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('blogs') }}",
          columns: [
              {data: 'id', name: '#'},
              {data: 'image', name: '{{__("Image")}}'},
              {data: 'name', name: '{{__("Name")}}'},
              {data: 'category_id', name: '{{__("Category")}}'},
              {data: 'created_at', name: '{{__("Created At")}}'},
              {
                  data: 'action',
                  name: 'action',
                  orderable: true,
                  searchable: true
              },
          ],

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
        var prevButton = $('<li>').addClass('page-item').append($('<a>').addClass('page-link').attr('href', 'javascript:void(0);').html('&laquo;'));
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
        var pageInfo = startRange + ' to ' + endRange + ' from ' + info.recordsTotal;
        $('#dataTables_my_info').text(pageInfo);

      });


    });

</script>

@endsection
