<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('assets') }}/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>@yield('title') &mdash; {{ config('app.name', 'Laravel') }}</title>

    <meta name="description" content="Most Powerful &amp; Comprehensive Bootstrap 5 Admin Dashboard built for developers!" />
    <meta name="keywords" content="dashboard, bootstrap 5 dashboard, bootstrap 5 design, bootstrap 5">

    {{-- Favicon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700&display=swap" rel="stylesheet" />

    {{-- Boxicons --}}
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />

    {{-- Core CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    {{-- Vendor CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    
    {{-- Select2 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    {{-- Page CSS --}}
    @stack('css')

    {{-- Helpers --}}
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>

    <style>
        /* CSS tambahan untuk menyesuaikan tampilan select2 */
        .select2-container .select2-selection--single {
            height: calc(1.5em + 0.75rem + 2px);
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            background-color: #fff;
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
        }

        .select2-container .select2-selection--single .select2-selection__rendered {
            line-height: calc(0.5em + 1rem + 2px);
            padding-left: 0.2rem;
        }

        .select2-container .select2-selection--single .select2-selection__arrow {
            height: calc(1.5em + 0.75rem + 2px);
            right: 0.75rem;
        }
    </style>
</head>

<body>

    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            {{-- Menu --}}
            @include('partials.menu')
            {{-- !Menu --}}

            <!-- Layout container -->
            <div class="layout-page">

                {{-- Navbar --}}
                @include('partials.navbar')
                {{-- !Navbar --}}

                {{-- Content Wrapper --}}
                <div class="content-wrapper">

                    {{-- Content --}}
                    @yield('content')
                    {{-- !Content --}}

                    {{-- Footer --}}
                    @include('partials.footer')
                    {{-- !Footer --}}

                    <div class="content-backdrop fade"></div>
                </div>
                {{-- !Content Wrapper --}}

            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>

    {{-- Core JS --}}
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>

    {{-- Main JS --}}
    <script src="{{ asset('assets/js/main.js') }}"></script>

    {{-- Select2 JS --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    {{-- Page JS --}}
    @stack('js')

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="{{ asset('assets/vendor/libs/github/github.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#regional, #nama_kantor').select2({
                tags: true,
                width: '100%'
            });

            $('#regional').change(function() {
                var regional = $(this).val();
                if (regional) {
                    $.ajax({
                        url: '/home/get-kantor-by-regional/' + regional,
                        type: 'GET',
                        success: function(data) {
                            $('#nama_kantor').empty().append('<option value="">Pilih Nama Kantor</option>');
                            $.each(data, function(index, value) {
                                $('#nama_kantor').append('<option value="'+ value.nama_kantor + ' - ' + value.id_kantor +'">'+ value.nama_kantor + ' - ' + value.id_kantor +'</option>');
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error("AJAX Error: ", status, error);
                        }
                    });
                } else {
                    $('#nama_kantor').empty().append('<option value="">Pilih Nama Kantor</option>');
                }
            });

            $('#nama_kantor').change(function() {
                var nama_kantor_id = $(this).val();
                if (nama_kantor_id) {
                    var nama_kantor = nama_kantor_id.split(' - ')[0];
                    $.ajax({
                        url: '/home/get-kantor-details/' + nama_kantor,
                        type: 'GET',
                        success: function(data) {
                            $('#jenis_kantor').val(data.jenis_kantor);
                            $('#pso_non_pso').val(data.pso_non_pso);
                            $('#kcu').val(data.kcu);
                            $('#kc').val(data.kc);
                        },
                        error: function(xhr, status, error) {
                            console.error("AJAX Error: ", status, error);
                        }
                    });
                }
            });

            function calculateKinerja(year) {
                var kurlog = parseFloat($(`#kinerja_${year}_kurlog`).val()) || 0;
                var jaskug = parseFloat($(`#kinerja_${year}_jaskug`).val()) || 0;
                var ritel = parseFloat($(`#kinerja_${year}_ritel`).val()) || 0;
                var biaya = parseFloat($(`#kinerja_${year}_biaya`).val()) || 0;

                var kurlogResult = kurlog * 0.2;
                var jaskugResult = jaskug * 0.6;
                var ritelResult = ritel * 0.2;

                var total = kurlogResult + jaskugResult + ritelResult - biaya;
                $(`#kinerja_${year}_total`).val(total);
            }

            $('#kinerja_2021_kurlog, #kinerja_2021_jaskug, #kinerja_2021_ritel, #kinerja_2021_biaya').on('input', function() {
                calculateKinerja(2021);
            });

            $('#kinerja_2022_kurlog, #kinerja_2022_jaskug, #kinerja_2022_ritel, #kinerja_2022_biaya').on('input', function() {
                calculateKinerja(2022);
            });

            $('#kinerja_2023_kurlog, #kinerja_2023_jaskug, #kinerja_2023_ritel, #kinerja_2023_biaya').on('input', function() {
                calculateKinerja(2023);
            });
        });
    </script>
</body>

</html>
