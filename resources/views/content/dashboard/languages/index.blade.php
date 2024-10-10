@extends('layouts/contentNavbarLayout')

@section('title', __('Manage Translations'))

@section('content')
<h4 class="py-3 mb-4" dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}">
    <span class="text-muted fw-light">{{ __('Pages') }} /</span> {{ __('Manage Translations') }}
</h4>

<!-- Translations Form -->
<div class="card row mb-4" dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}">
    <h5 class="card-header">{{ __('Manage Translations') }}</h5>
    <div class="card-body">
        <form id="translations-form" method="POST" action="{{ route('translations.store') }}">
            @csrf
            <div class="repeater">
                <div data-repeater-list="translations">
                    <div data-repeater-item class="row mb-2">
                        <div class="col-md-3">
                          <select name="language" class="form-control" required>
                            <option value="">{{ __('Select Language') }}</option>
                            @foreach (config('language') as $locale => $language)
                                <option value="{{ $locale }}">{{ __($language) }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="word" class="form-control" placeholder="{{ __('Word') }}" required>
                        </div>
                        <div class="col-md-3">
                          <input type="text" name="translate" class="form-control" placeholder="{{ __('Translate') }}" required>
                        </div>
                        <div class="col-md-2">
                            <button type="button" data-repeater-delete class="btn btn-icon btn-outline-danger">
                              <span class="tf-icons mdi mdi-trash-can-outline"></span>
                            </button>
                        </div>
                    </div>
                </div>
                <button type="button" data-repeater-create class="btn btn-icon btn-primary">
                  <span class="tf-icons mdi mdi-plus-outline"></span>
                </button>
            </div>
            <button type="submit" class="btn btn-success mt-3">{{ __('Submit') }}</button>
        </form>
    </div>
</div>
<!--/ Translations Form -->
<div class="row">
  @foreach($words as $word => $translations)
      <div class="col-md-4 {{ app()->isLocale('ar')? 'text-end' : '' }}" dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}">
          <div class="card mb-4">
              <div class="card-header">
                  {{ $word }} <!-- Word key as header -->
              </div>
              <div class="card-body">
                  <ul class="list-unstyled {{ app()->isLocale('ar')? 'px-0' : '' }}">
                      @foreach($languages as $lang)
                          <li class="d-flex mb-2">
                            <div class="avatar {{ app()->isLocale('ar')? 'ms-1' : 'me-1' }}">
                              <div class="avatar-initial bg-label-success text-uppercase">
                                {{ $lang }}
                              </div>
                            </div>
                              <input type="text" class="form-control" value="{{ $translations[$lang] ?? '' }}" placeholder="{{ __('Not available') }}">
                              {{-- {{ $translations[$lang] ?? __('Not available') }} <!-- Display translation or 'Not available' --> --}}
                          </li>
                      @endforeach
                  </ul>
              </div>
          </div>
      </div>
  @endforeach
</div>


<!-- Include jQuery and jQuery Repeater -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery.repeater@1.2.1/jquery.repeater.min.js"></script>
<script type="text/javascript">
    $('.repeater').repeater({
        initEmpty: false,
        show: function () {
            $(this).slideDown();
        },
        hide: function (deleteElement) {
            $(this).slideUp(deleteElement);
        },
    });
</script>
@endsection
