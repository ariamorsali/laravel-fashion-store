<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.layouts.head-tag')
    @yield('head-tag')
</head>

<body class="sb-nav-fixed">
    @include('admin.layouts.header')

    <div id="layoutSidenav">
        @include('admin.layouts.sidebar')
        <div id="layoutSidenav_content">
            <main>
               @yield('content') 
            </main>
            @include('admin.layouts.footer')
        </div>
    </div>

    @include('admin.layouts.script')
    @yield('script')

    <section class="toast-wrapper flex-row-reverse">
        @include('admin.alerts.toast.success')
        @include('admin.alerts.toast.error')
    </section>

    
    @include('admin.alerts.sweetalert.success')
    @include('admin.alerts.sweetalert.error')

</body>

</html>
