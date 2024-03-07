<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIAKAD - {{ $title }}</title>
    <link rel="shortcut icon" href="{{ asset('dist') }}/assets/compiled/svg/favicon.svg"
        type="image/x-icon">
    <link rel="shortcut icon"
        href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACEAAAAiCAYAAADRcLDBAAAEs2lUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iWE1QIENvcmUgNS41LjAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6ZXhpZj0iaHR0cDovL25zLmFkb2JlLmNvbS9leGlmLzEuMC8iCiAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyIKICAgIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIKICAgIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIKICAgIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIgogICAgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIKICAgZXhpZjpQaXhlbFhEaW1lbnNpb249IjMzIgogICBleGlmOlBpeGVsWURpbWVuc2lvbj0iMzQiCiAgIGV4aWY6Q29sb3JTcGFjZT0iMSIKICAgdGlmZjpJbWFnZVdpZHRoPSIzMyIKICAgdGlmZjpJbWFnZUxlbmd0aD0iMzQiCiAgIHRpZmY6UmVzb2x1dGlvblVuaXQ9IjIiCiAgIHRpZmY6WFJlc29sdXRpb249Ijk2LjAiCiAgIHRpZmY6WVJlc29sdXRpb249Ijk2LjAiCiAgIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiCiAgIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIKICAgeG1wOk1vZGlmeURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiCiAgIHhtcDpNZXRhZGF0YURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiPgogICA8eG1wTU06SGlzdG9yeT4KICAgIDxyZGY6U2VxPgogICAgIDxyZGY6bGkKICAgICAgc3RFdnQ6YWN0aW9uPSJwcm9kdWNlZCIKICAgICAgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWZmaW5pdHkgRGVzaWduZXIgMS4xMC4xIgogICAgICBzdEV2dDp3aGVuPSIyMDIyLTAzLTMxVDEwOjUwOjIzKzAyOjAwIi8+CiAgICA8L3JkZjpTZXE+CiAgIDwveG1wTU06SGlzdG9yeT4KICA8L3JkZjpEZXNjcmlwdGlvbj4KIDwvcmRmOlJERj4KPC94OnhtcG1ldGE+Cjw/eHBhY2tldCBlbmQ9InIiPz5V57uAAAABgmlDQ1BzUkdCIElFQzYxOTY2LTIuMQAAKJF1kc8rRFEUxz9maORHo1hYKC9hISNGTWwsRn4VFmOUX5uZZ36oeTOv954kW2WrKLHxa8FfwFZZK0WkZClrYoOe87ypmWTO7dzzud97z+nec8ETzaiaWd4NWtYyIiNhZWZ2TvE946WZSjqoj6mmPjE1HKWkfdxR5sSbgFOr9Ll/rXoxYapQVik8oOqGJTwqPL5i6Q5vCzeo6dii8KlwpyEXFL519LjLLw6nXP5y2IhGBsFTJ6ykijhexGra0ITl5bRqmWU1fx/nJTWJ7PSUxBbxJkwijBBGYYwhBgnRQ7/MIQIE6ZIVJfK7f/MnyUmuKrPOKgZLpEhj0SnqslRPSEyKnpCRYdXp/9++msneoFu9JgwVT7b91ga+LfjetO3PQ9v+PgLvI1xkC/m5A+h7F32zoLXug38dzi4LWnwHzjeg8UGPGbFfySvuSSbh9QRqZ6H+Gqrm3Z7l9zm+h+iafNUV7O5Bu5z3L/wAdthn7QIme0YAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAJTSURBVFiF7Zi9axRBGIefEw2IdxFBRQsLWUTBaywSK4ubdSGVIY1Y6HZql8ZKCGIqwX/AYLmCgVQKfiDn7jZeEQMWfsSAHAiKqPiB5mIgELWYOW5vzc3O7niHhT/YZvY37/swM/vOzJbIqVq9uQ04CYwCI8AhYAlYAB4Dc7HnrOSJWcoJcBS4ARzQ2F4BZ2LPmTeNuykHwEWgkQGAet9QfiMZjUSt3hwD7psGTWgs9pwH1hC1enMYeA7sKwDxBqjGnvNdZzKZjqmCAKh+U1kmEwi3IEBbIsugnY5avTkEtIAtFhBrQCX2nLVehqyRqFoCAAwBh3WGLAhbgCRIYYinwLolwLqKUwwi9pxV4KUlxKKKUwxC6ZElRCPLYAJxGfhSEOCz6m8HEXvOB2CyIMSk6m8HoXQTmMkJcA2YNTHm3congOvATo3tE3A29pxbpnFzQSiQPcB55IFmFNgFfEQeahaAGZMpsIJIAZWAHcDX2HN+2cT6r39GxmvC9aPNwH5gO1BOPFuBVWAZue0vA9+A12EgjPadnhCuH1WAE8ivYAQ4ohKaagV4gvxi5oG7YSA2vApsCOH60WngKrA3R9IsvQUuhIGY00K4flQG7gHH/mLytB4C42EgfrQb0mV7us8AAMeBS8mGNMR4nwHamtBB7B4QRNdaS0M8GxDEog7iyoAguvJ0QYSBuAOcAt71Kfl7wA8DcTvZ2KtOlJEr+ByyQtqqhTyHTIeB+ONeqi3brh+VgIN0fohUgWGggizZFTplu12yW8iy/YLOGWMpDMTPXnl+Az9vj2HERYqPAAAAAElFTkSuQmCC"
        type="image/png">
    <link rel="stylesheet" href="{{ asset('dist') }}/assets/compiled/css/app.css">
    <link rel="stylesheet" href="{{ asset('dist') }}/assets/compiled/css/app-dark.css">
    <link rel="stylesheet" href="{{ asset('dist') }}/assets/compiled/css/iconly.css">
    {{-- filepond --}}
    <link rel="stylesheet" href="{{ asset('dist') }}/assets/extensions/filepond/filepond.css">
    <link rel="stylesheet" href="{{ asset('dist') }}/assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.css">
    {{-- toast --}}
    <link rel="stylesheet" href="{{ asset('dist') }}/assets/extensions/toastify-js/src/toastify.css">
    <link rel="stylesheet" href="{{ asset('dist') }}/assets/extensions/sweetalert2/sweetalert2.min.css">
    <style>
        .layout-horizontal .main-navbar {
            background-color: #178c52
        }
        html[data-bs-theme=dark] .layout-horizontal .header-top .logo img{
            height: 60px;
        }
        .layout-horizontal .header-top .logo img{
            height: 60px;
        }
        .layout-horizontal .main-navbar {
            padding: 0.5rem;
        }
        .layout-horizontal .main-navbar ul .menu-link {
            color: #ffffff !important;
        }
        .card {
            --bs-card-cap-bg: #f9f07a;
        }
    </style>
    <style>
        html[data-bs-theme=dark] .layout-horizontal .header-top .logo img{
            height: 60px;
        }
        .layout-horizontal .header-top .logo img{
            height: 60px;
        }
        #logo-bca {
            width: 200px !important;
            height: 150px !important;
        }
    </style>
</head>

<body class="light dark">
    <script src="{{ asset('dist') }}/assets/static/js/initTheme.js"></script>
    <div id="app">
        <div id="main" class="layout-horizontal">
            <header class="mb-5">
                <div class="header-top">
                    <div class="container">
                        <div class="logo">
                            <a href="index.html"><img
                                    src="{{ asset('dist') }}/assets/compiled/png/logo.png"
                                    alt="Logo"></a>
                        </div>
                        <div class="header-top-right">
                            <div class="dropdown">
                                <a href="#" id="topbarUserDropdown"
                                    class="user-dropdown d-flex align-items-center dropend dropdown-toggle "
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="avatar avatar-md2">
                                        <img src="{{ asset('dist') }}/assets/compiled/jpg/1.jpg"
                                            alt="Avatar">
                                    </div>
                                    <div class="text">
                                        <h6 class="user-dropdown-name">{{ Auth::user()->nama }}</h6>
                                        <p class="user-dropdown-status text-sm text-muted">Calon Mahasiswa</p>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow-lg"
                                    aria-labelledby="topbarUserDropdown">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                            <i class="icon-mid bi bi-box-arrow-left me-2"></i> Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>

                            <!-- Burger button responsive -->
                            <a href="#" class="burger-btn d-block d-xl-none">
                                <i class="bi bi-justify fs-3"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <nav class="main-navbar">
                    <div class="container">
                        <ul>
                            <li class="menu-item  ">
                                <a href="/pendaftaran" class='menu-link'>
                                    <span><i class="bi bi-clipboard"></i> Pendaftaran Mahasiswa Baru</span>
                                </a>
                            </li>
                            <li class="menu-item  ">
                                <a href="/pendaftaran-pengumuman" class='menu-link'>
                                    <span><i class="bi bi-bell"></i> Pengumuman</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </nav>

            </header>

            <div class="content-wrapper container">

                <div class="page-heading">
                </div>
                <div class="page-content">
                    <section class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h2>{{ $title }}</h2>
                                </div>
                                <div class="card-body text-center">
                                    @if ($pengumuman == null)
                                        <h5 class="mt-3">
                                            Anda belum melakukan pendaftaran, segera lakukan Pendaftaran Mahasiswa Baru!
                                        </h5>
                                    @else
                                        @if ($pengumuman->status == 1)
                                            <h5 class="mt-3">
                                                SELAMAT ANDA DINYATAKAN DITERIMA
                                            </h5>
                                            <p>{{ $pengumuman->prodi->nama_prodi }}</p>
                                        @elseif ($pengumuman->status == 3)
                                            <h5 class="mt-3">
                                                MOHON MAAF ANDA DINYATAKAN <b>TIDAK DITERIMA</b>
                                            </h5>
                                            <p>
                                                {{ $pengumuman->keterangan }}
                                            </p>
                                        @else
                                            <h5 class="mt-3">
                                                Proses Pendaftaran anda sedang dalam proses, penerimaan akan diumumkan setelah proses selesai!
                                            </h5>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

            </div>

            <footer>
                <div class="container">
                    <div class="footer clearfix mb-0 text-muted">
                        <div class="float-end">
                            <p>STAINU PACITAN <span class="text-danger"></p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="{{ asset('dist') }}/assets/static/js/components/dark.js"></script>
    <script src="{{ asset('dist') }}/assets/static/js/pages/horizontal-layout.js"></script>
    <script src="{{ asset('dist') }}/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js">
    </script>
    <script src="{{ asset('dist') }}/assets/compiled/js/app.js"></script>
    {{-- filepond --}}
    <script src="{{ asset('dist') }}/assets/extensions/filepond-plugin-file-validate-type/filepond-plugin-file-validate-type.min.js"></script>
    <script src="{{ asset('dist') }}/assets/extensions/filepond-plugin-image-crop/filepond-plugin-image-crop.min.js"></script>
    <script src="{{ asset('dist') }}/assets/extensions/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js"></script>
    <script src="{{ asset('dist') }}/assets/extensions/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js"></script>
    <script src="{{ asset('dist') }}/assets/extensions/filepond-plugin-image-filter/filepond-plugin-image-filter.min.js"></script>
    <script src="{{ asset('dist') }}/assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js"></script>
    <script src="{{ asset('dist') }}/assets/extensions/filepond-plugin-image-resize/filepond-plugin-image-resize.min.js"></script>
    <script src="{{ asset('dist') }}/assets/extensions/filepond/filepond.js"></script>
    <script src="{{ asset('dist') }}/assets/extensions/toastify-js/src/toastify.js"></script>
    <script src="{{ asset('dist') }}/assets/static/js/pages/filepond.js"></script>

    <script src="{{asset('jquery')}}/jquery.min.js"></script>
    <script src="{{asset('js')}}/toast.js"></script>
    <script>
        $(document).ready(function () {
            $('#save').click(function(){
                var form = $('#form')[0],
                data = new FormData(form);
                
                $('.spinner').css('display','block');
                $(this).css('display','none');

                $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "/pendaftaran",
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    data: data,
                    success: function(result) {
                        if (result.success) {
                            successMsg(result.success)
                            $('.spinner').css('display','none');
                            $('#save').css('display','block');
                            $('#form').find('input').val('');
                            location.reload();
                        } else {
                            $('.spinner').css('display','none');
                            $('#save').css('display','block');
                            $.each(result.errors, function(key, value) {
                                errorMsg(value)
                            });
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>
