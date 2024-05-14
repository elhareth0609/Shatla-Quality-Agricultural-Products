@extends('layouts.homeLayout')

@section('title', __('Diseases Predict'))

@section('page-script')
<script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
@endsection

@section('content')
<div class="container my-w-fit-content my-1">
  <form class="justify-content-center" method="POST" action="{{ route('diseases.predict',$type->id) }}" enctype="multipart/form-data">
    @csrf

    {{-- <input class="form-control mb-1" type="file" id="formFile" name="file"> --}}
    <img src="{{asset('assets/img/photos/diseases/predict.png')}}" alt="user-avatar" class="d-block w-px-250 h-px-250 rounded mb-2 mx-auto" id="uploadedAvatar" />

    <div class="row justify-content-center">
      <label for="upload" class="btn btn-primary me-2 mb-3 my-w-fit-content" tabindex="0">
        <span class="d-none d-sm-block">{{ __('Upload') }}</span>
        <i class="mdi mdi-tray-arrow-up d-block d-sm-none"></i>
        <input type="file" id="upload" class="account-file-input" name="file" hidden accept="image/png, image/jpeg" />
      </label>
    </div>
    <div class="row justify-content-center">
      <button type="submit" class="btn btn-outline-success mb-3 my-w-fit-content">
        <i class="mdi mdi-reload d-block d-sm-none"></i>
        <span class="d-none d-sm-block">{{ __('Predict') }}</span>
      </button>
    </div>
    {{-- <div class="card-body">
      <div class="d-flex align-items-start align-items-sm-center gap-4">
        <img src="{{asset('assets/img/avatars/1.png')}}" alt="user-avatar" class="d-block w-px-120 h-px-120 rounded" id="uploadedAvatar" />
        <div class="button-wrapper">
          <label for="upload" class="btn btn-primary me-2 mb-3" tabindex="0">
            <span class="d-none d-sm-block">Upload new photo</span>
            <i class="mdi mdi-tray-arrow-up d-block d-sm-none"></i>
            <input type="file" id="upload" class="account-file-input" hidden accept="image/png, image/jpeg" />
          </label>
          <button type="button" class="btn btn-outline-danger account-image-reset mb-3">
            <i class="mdi mdi-reload d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Reset</span>
          </button>

          <div class="text-muted small">Allowed JPG, GIF or PNG. Max size of 800K</div>
        </div>
      </div>
    </div> --}}
  </form>
</div>


@endsection
