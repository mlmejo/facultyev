<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Evaluation System') }}</title>

  <link rel="stylesheet" href="{{ asset('css/app.min.css') }}">
  <script src="{{ asset('js/vendor.min.js') }}"></script>

  @stack('stylesheets')
</head>

<body>
  @yield('content')

  <script>
    feather.replace();

    $(() => {
      $(".dataTable").DataTable();

      $(".select2").select2({
        theme: "bootstrap-5",
        selectionCssClass: 'select2--small',
        dropdownCssClass: 'select2--small',
      });

      $.ajaxSetup({
        headers: {
          "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content")
        }
      });
    })
  </script>

  @stack('scripts')
</body>

</html>
