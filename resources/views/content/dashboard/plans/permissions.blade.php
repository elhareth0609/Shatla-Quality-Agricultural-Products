@extends('layouts/contentNavbarLayout')

@section('title', __('Permissions'))

@section('content')
<h4 class="py-3 mb-4" dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}"><span class="text-muted fw-light">{{ __('Pages') }} /</span> {{ __('Permissions') }}
</h4>

@section('page-script')
<script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
@endsection

<div class="row">
  <div class="col-md-12">
    <ul class="nav nav-pills flex-column flex-md-row mb-4 gap-2 gap-lg-0">
      <li class="nav-item"><a class="nav-link" href="{{ route('plan.get',$plan->id)}}"><i class="mdi mdi-account-outline mdi-20px me-1"></i>{{ __('Account') }}</a></li>
      <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i class="mdi mdi-security mdi-20px me-1"></i>{{ __('Permissions') }}</a></li>
      {{-- <li class="nav-item"><a class="nav-link" href="{{url('pages/account-settings-connections')}}"><i class="mdi mdi-link mdi-20px me-1"></i>{{ __('Connections') }}</a></li> --}}
    </ul>

  <!-- Responsive Table -->
  <div class="card row" dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}">
    <h5 class="card-header">{{ __('Permissions') }}</h5>
    <div class="row">
      <input class="form-control my-w-fit-content mb-3 mx-1" type="search" placeholder="{{ __('Search ...') }}" id="dataTables_my_filter" />

      <select class="form-select text-center my-w-fit-content mb-3 mx-1" id="dataTables_my_length" aria-label="Default select example">
        <option value="10">10</option>
        <option value="25">25</option>
        <option value="50">50</option>
        <option value="100" selected>100</option>
      </select>

      <button type="button" class="btn btn-icon btn-outline-primary mb-3 mx-1">
        <span class="tf-icons mdi mdi-plus-outline"></span>
      </button>
  </div>

  <div class="table-responsive text-nowrap">
    <table class="table table-striped w-100" id="permissions" data-page-length='100'>
      <thead>
        <tr class="text-nowrap">
          <th>#</th>
          <th>{{ __("Permission") }}</th>
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
</div>
<!--/ Responsive Table -->

<script type="text/javascript">

$(document).ready(function() {
  $.noConflict();
      var lang = "{{ app()->getLocale() }}";
      var table = $('#permissions').DataTable({
          processing: true,
          serverSide: true,
          language: {
            "emptyTable": __("No data available in table",lang),
            "zeroRecords": __("No matching records found",lang)
          },
          ajax: "{{ route('plan.permissions.table', ['id' => $plan->id]) }}",
          columns: [
              {data: 'id', name: '#'},
              {data: 'permission_id', name: '{{__("Permission")}}'},
              {data: 'created_at', name: '{{__("Created At")}}'}
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
