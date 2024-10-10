<!-- laravel style -->
<script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

<!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
<script src="{{ asset('assets/js/config.js') }}"></script>

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>


<!-- BEGIN: Api JS-->
<!-- Place the first <script> tag in your HTML's <head> -->
  <script src="https://cdn.tiny.cloud/1/7gjdmwd28tv3zgd10agg1omfs4akvf56ukwbb85qqzlzgxd1/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

  {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> --}}
  {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> --}}

<script src="{{ asset('assets/js/fullcalendar.min.js') }}?v={{ time() }}"></script>
<script src="{{ asset('assets/js/jquery.min.js') }}?v={{ time() }}"></script>
<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}?v={{ time() }}"></script>
<script src="{{ asset('assets/js/sweetalert.js') }}?v={{ time() }}"></script>
<script src="{{ asset('assets/js/tagify.js') }}?v={{ time() }}"></script>
<script src="{{ asset('assets/js/tagify.polyfills.min.js') }}?v={{ time() }}"></script>
<script src="{{ asset('assets/js/clipboard.min.js') }}?v={{ time() }}"></script>
<script src="{{ asset('assets/js/pusher.min.js') }}?v={{ time() }}"></script>
<script src="{{ asset('assets/js/lottie.min.js') }}?v={{ time() }}"></script>
<script src="{{ asset('assets/js/dropzone-min.js') }}?v={{ time() }}"></script>



{{-- <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.12.2/lottie.min.js"></script> --}}
{{-- <link rel="stylesheet" href="https://cdn.datatables.net/2.1.7/css/dataTables.dataTables.min.css" /> --}}

<!-- Bootstrap JS -->
<link rel="stylesheet" href="{{ asset('assets/css/dropzone.css') }}?v={{ time() }}" />
<link rel="stylesheet" href="{{ asset('assets/css/tagify.css') }}?v={{ time() }}" />





<link rel="stylesheet" href="{{ asset('assets/css/mine.css') }}?v={{ time() }}" />
<script src="{{ asset('assets/js/mine.js') }}?v={{ time() }}"></script>

<!-- END: Api JS-->
