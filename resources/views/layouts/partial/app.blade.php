<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Properti Management</title>
    <link rel="icon" type="image/png" href="https://i.ibb.co/zc5rd26/favicon.png">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    {{-- Icons & Base Styles --}}
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">

    {{-- Custom Navbar, Sidebar & Layout CSS --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ time() }}">

    {{-- Global UI Components --}}
    <link rel="stylesheet" href="{{ asset('assets/css/components/card.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components/table.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components/search.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components/pagination.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components/modal.css') }}?v={{ time() }}">

    {{-- Plugin CSS --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    @stack('styles')
</head>

<body>
{{-- Backdrop Gelap saat Sidebar Terbuka di Mobile / Tablet --}}
<div class="sidebar-backdrop" id="sidebarBackdrop"></div>

<div class="container-scroller">
    {{-- Custom Navbar --}}
    @include('layouts.navbar')

    <div class="container-fluid page-body-wrapper px-0">
        {{-- Custom Sidebar --}}
        @include('layouts.sidebar')

        {{-- Main Content Panel --}}
        <div class="main-panel">
            <div class="content-wrapper">
                @yield('content')
            </div>

            @include('layouts.footer')
        </div>
    </div>
</div>

{{-- Base Script --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/5.3.0/fabric.min.js"></script>
<script src="{{ asset('admin/assets/vendors/js/vendor.bundle.base.js') }}"></script>

{{-- DIMATIKAN: Script Navbar & Sidebar Bawaan Template (Digantikan oleh js/app.js) --}}
{{-- <script src="{{ asset('admin/assets/js/off-canvas.js') }}"></script> --}}
{{-- <script src="{{ asset('admin/assets/js/misc.js') }}"></script> --}}

{{-- Plugin JS --}}
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- Custom Navbar & Sidebar Interaction JS --}}
<script src="{{ asset('js/app.js') }}?v={{ time() }}"></script>

@stack('scripts')

</body>
</html>