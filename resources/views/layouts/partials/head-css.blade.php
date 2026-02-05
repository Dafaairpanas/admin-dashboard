<!-- Icon Fonts CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet"
    href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/icofont@1.0.1/dist/icofont.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/iconoir-icons/iconoir@main/css/iconoir.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.2.96/css/materialdesignicons.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation-icons/3.0.1/foundation-icons.min.css">

<!-- Custom Sidebar Styles -->
<link rel="stylesheet" href="{{ asset('css/sidebar-custom.css') }}">

<!-- Fix Pagination SVG Size -->
<style>
    .pagination svg {
        width: 1rem !important;
        height: 1rem !important;
        max-width: 1rem !important;
        max-height: 1rem !important;
    }
</style>

@yield('css')
@vite(['resources/scss/bootstrap.scss', 'resources/scss/app.scss'])