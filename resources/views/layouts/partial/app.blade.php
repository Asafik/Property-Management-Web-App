<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Properti Management</title>
     <link rel="icon" type="image/png" href="https://i.ibb.co/zc5rd26/favicon.png">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">
    <!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

</head>

<body>
<div class="container-scroller">

    @include('layouts.navbar')

    <div class="container-fluid page-body-wrapper">

        @include('layouts.sidebar')

        <div class="main-panel">
            <div class="content-wrapper">
                @yield('content')
            </div>

            @include('layouts.footer')
        </div>

    </div>
</div>

<script src="{{ asset('admin/assets/vendors/js/vendor.bundle.base.js') }}"></script>
<script src="{{ asset('admin/assets/vendors/chart.js/chart.umd.js') }}"></script>
<script src="{{ asset('admin/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/off-canvas.js') }}"></script>
<script src="{{ asset('admin/assets/js/misc.js') }}"></script>
<script src="{{ asset('admin/assets/js/settings.js') }}"></script>
<script src="{{ asset('admin/assets/js/todolist.js') }}"></script>
<script src="{{ asset('admin/assets/js/jquery.cookie.js') }}"></script>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

@stack('scripts')

</body>
</html>
