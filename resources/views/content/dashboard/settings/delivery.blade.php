@extends('layouts/contentNavbarLayout')

@section('title', __('Delivery'))

@section('content')
<h4 class="py-3 mb-4" dir="{{ app()->isLocale('ar') ? 'rtl' : '' }}"><span class="text-muted fw-light">{{ __('Pages') }} /</span> {{ __('Delivery') }}
</h4>

<form id="contentForm" method="POST" action="{{ route('delivery.update') }}">
  @csrf
  <textarea name="content">
    {{ $content }}
  </textarea>
</form>

<style>

</style>

<script type="text/javascript">

$(document).ready(function() {

  tinymce.init({
    selector: 'textarea',
    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount linkchecker markdown',
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat | Save',
    setup: function (editor) {
      editor.ui.registry.addButton('save', {
        text: 'Save',
        onAction: function () {
          $('textarea[name="content"]').val(editor.getContent());
          $('#contentForm').submit();
        }
      });
    }

  });

  $('#contentForm').submit(function(event) {
    event.preventDefault();

    $.ajax({
        url: $(this).attr('action'),
        type: $(this).attr('method'),
        data: $(this).serialize(),
        dataType: "json",
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
});



  });

</script>

@endsection
