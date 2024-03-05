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
                                <a href="index.html" class='menu-link'>
                                    <span><i class="bi bi-clipboard"></i> Pendaftaran Mahasiswa Baru</span>
                                </a>
                            </li>
                            <li class="menu-item  ">
                                <a href="index.html" class='menu-link'>
                                    <span><i class="bi bi-bell"></i> Pengumuman</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </nav>

            </header>

            <div class="content-wrapper container">

                <div class="page-heading">
                    <h3>{{ $title }}</h3>
                </div>
                <div class="page-content">
                    <section class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Form {{ $title }}</h4>
                                </div>
                                <div class="card-body">
                                    <form id="form">
                                        @csrf
                                        {{-- Start section Biodata Diri --}}
                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                        <input type="hidden" name="tahun_ajaran_id" value="{{ $tahun_ajaran->id }}">
                                        <div class="divider">
                                            <div class="divider-text">Biodata Diri</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="nama">Nama Lengkap</label>
                                            </div>
                                            @error('nama')
                                                <span class="text-danger">
                                                    *<strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="nama" class="form-control @error('nama') is-invalid @enderror" name="nama"
                                                    value="{{ Auth::user()->nama }}">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="tempat_lahir">Tempat & Tanggal Lahir</label>
                                            </div>
                                            @error('tempat_lahir')
                                                <span class="text-danger">
                                                    *<strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="col-md-4 form-group">
                                                <input type="text" id="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" name="tempat_lahir">
                                            </div>
                                            @error('tgl_lahir')
                                                <span class="text-danger">
                                                    *<strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="col-md-4 form-group">
                                                <input type="date" id="tgl_lahir" class="form-control @error('tgl_lahir') is-invalid @enderror" name="tgl_lahir">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                            </div>
                                            @error('jenis_kelamin')
                                                <span class="text-danger">
                                                    *<strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="col-md-8 form-group">
                                                <select class="form-select @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin" name="jenis_kelamin">
                                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                                    <option value="Laki-laki">Laki-laki</option>
                                                    <option value="Perempuan">Perempuan</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="alamat">Alamat</label>
                                            </div>
                                            @error('alamat')
                                                <span class="text-danger">
                                                    *<strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="alamat" class="form-control @error('alamat') is-invalid @enderror" name="alamat">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="telp">Nomor Telepon</label>
                                            </div>
                                            @error('telp')
                                                <span class="text-danger">
                                                    *<strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="telp" class="form-control @error('telp') is-invalid @enderror" name="telp"
                                                    value="{{ Auth::user()->telp }}">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="email">Email</label>
                                            </div>
                                            @error('email')
                                                <span class="text-danger">
                                                    *<strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                                    value="{{ Auth::user()->email }}">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="nik">Nomor Induk Kependudukan (NIK)</label>
                                            </div>
                                            @error('nik')
                                                <span class="text-danger">
                                                    *<strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="nik" class="form-control @error('nik') is-invalid @enderror" name="nik"
                                                    onkeypress="return isNumber(event)">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="nisn">Nomor Induk Siswa Nasional (NISN)</label>
                                            </div>
                                            @error('nisn')
                                                <span class="text-danger">
                                                    *<strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="nisn" class="form-control @error('nisn') is-invalid @enderror" name="nisn"
                                                    onkeypress="return isNumber(event)">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="jenis_sekolah">Jenis Sekolah</label>
                                            </div>
                                            @error('jenis_sekolah')
                                                <span class="text-danger">
                                                    *<strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="col-md-8 form-group">
                                                <select class="form-select @error('jenis_sekolah') is-invalid @enderror" id="jenis_sekolah" name="jenis_sekolah">
                                                    <option value="">-- Pilih Jenis Sekolah --</option>
                                                    <option value="SMA">SMA</option>
                                                    <option value="SMK">SMK</option>
                                                    <option value="Madarasah">Madarasah</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="nama_sekolah">Nama Sekolah</label>
                                            </div>
                                            @error('nama_sekolah')
                                                <span class="text-danger">
                                                    *<strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="nama_sekolah" class="form-control @error('nama_sekolah') is-invalid @enderror" name="nama_sekolah">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="jurusan">Jurusan Sekolah</label>
                                            </div>
                                            @error('jurusan_sekolah')
                                                <span class="text-danger">
                                                    *<strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="jurusan_sekolah" class="form-control @error('jurusan_sekolah') is-invalid @enderror" name="jurusan_sekolah"
                                                    placeholder="Contoh : IPA">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="periode">Periode Sekolah</label>
                                            </div>
                                            @error('tahun_masuk')
                                                <span class="text-danger">
                                                    *<strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="col-md-4 form-group">
                                                <input type="text" id="tahun_masuk" class="form-control @error('tahun_masuk') is-invalid @enderror" name="tahun_masuk"
                                                    placeholder="Tahun Masuk" onkeypress="return isNumber(event)">
                                            </div>
                                            @error('tahun_lulus')
                                                <span class="text-danger">
                                                    *<strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="col-md-4 form-group">
                                                <input type="text" id="tahun_lulus" class="form-control @error('tahun_lulus') is-invalid @enderror" name="tahun_lulus"
                                                    placeholder="Tahun Lulus" onkeypress="return isNumber(event)">
                                            </div>
                                        </div>
    
                                        {{-- End section Biodata Diri --}}
    
                                        {{-- Start section Biodata Ayah --}}
                                        <div class="divider divider-left">
                                            <div class="divider-text">Biodata Ayah</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="nama_ayah">Nama Lengkap</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="nama_ayah" class="form-control" name="nama_ayah">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="tempat_lahir">Tempat & Tanggal Lahir</label>
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <input type="text" id="tempat_lahir_ayah" class="form-control"
                                                    name="tempat_lahir_ayah">
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <input type="date" id="tgl_lahir_ayah" class="form-control" name="tgl_lahir_ayah">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="nik">Nomor Induk Kependudukan (NIK)</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="nik_ayah" class="form-control" name="nik_ayah"
                                                    onkeypress="return isNumber(event)">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="alamat_ayah">Alamat</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="alamat_ayah" class="form-control" name="alamat_ayah">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="pendidikan_ayah">Pendidikan Terakhir</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <select class="form-select" id="pendidikan_ayah" name="pendidikan_ayah">
                                                    <option value="">-- Pilih Pendidikan Terakhir--</option>
                                                    <option value="SD">SD</option>
                                                    <option value="SMP">SMP</option>
                                                    <option value="SMA">SMA</option>
                                                    <option value="D-1">D-1</option>
                                                    <option value="D-2">D-2</option>
                                                    <option value="D-3">D-3</option>
                                                    <option value="D-4">D-4</option>
                                                    <option value="S-1">S-1</option>
                                                    <option value="S-2">S-2</option>
                                                    <option value="S-3">S-3</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="pekerjaan_ayah">Pekerjaan</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="pekerjaan_ayah" class="form-control" name="pekerjaan_ayah">
                                            </div>
                                        </div>
                                        {{-- End section Biodata Ayah --}}
    
                                        {{-- Start section Biodata Ibu --}}
                                        <div class="divider">
                                            <div class="divider-text">Biodata Ibu</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="nama_ibu">Nama Lengkap</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="nama_ibu" class="form-control" name="nama_ibu">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="tempat_lahir">Tempat & Tanggal Lahir</label>
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <input type="text" id="tempat_lahir_ibu" class="form-control"
                                                    name="tempat_lahir_ibu">
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <input type="date" id="tgl_lahir_ibu" class="form-control" name="tgl_lahir_ibu">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="nik">Nomor Induk Kependudukan (NIK)</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="nik_ibu" class="form-control" name="nik_ibu"
                                                    onkeypress="return isNumber(event)">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="alamat_ibu">Alamat</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="alamat_ibu" class="form-control" name="alamat_ibu">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="pendidikan_ibu">Pendidikan Terakhir</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <select class="form-select" id="pendidikan_ibu" name="pendidikan_ibu">
                                                    <option value="">-- Pilih Pendidikan Terakhir--</option>
                                                    <option value="SD">SD</option>
                                                    <option value="SMP">SMP</option>
                                                    <option value="SMA">SMA</option>
                                                    <option value="D-1">D-1</option>
                                                    <option value="D-2">D-2</option>
                                                    <option value="D-3">D-3</option>
                                                    <option value="D-4">D-4</option>
                                                    <option value="S-1">S-1</option>
                                                    <option value="S-2">S-2</option>
                                                    <option value="S-3">S-3</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="pekerjaan_ibu">Pekerjaan</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="pekerjaan_ibu" class="form-control" name="pekerjaan_ibu">
                                            </div>
                                        </div>
                                        {{-- End section Biodata Ibu --}}
    
                                        {{-- Start section Dokumen --}}
                                        <div class="divider">
                                            <div class="divider-text">Dokumen</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="file">File Ijazah</label>
                                            </div>
                                            @error('file')
                                                <span class="text-danger">
                                                    *<strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="col-md-8 form-group">
                                                <input type="file" class="basic-filepond @error('file') is-invalid @enderror" id="file" name="file">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="no_ijazah">No Ijazah</label>
                                            </div>
                                            @error('no_ijazah')
                                                <span class="text-danger">
                                                    *<strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="no_ijazah" class="form-control @error('no_ijazah') is-invalid @enderror" name="no_ijazah">
                                            </div>
                                        </div>
                                        {{-- End section Dokumen --}}
    
                                        {{-- Start section Jurusan --}}
                                        <div class="divider">
                                            <div class="divider-text">Program Studi</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="prodi_id">Program Studi</label>
                                            </div>
                                            @error('prodi_id')
                                                <span class="text-danger">
                                                    *<strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="col-md-8 form-group">
                                                <select class="form-select @error('prodi_id') is-invalid @enderror" id="prodi_id" name="prodi_id">
                                                    <option value="">-- Pilih Program Studi--</option>
                                                    @foreach($prodi as $p)
                                                        <option value="{{ $p->id }}">{{ $p->nama_prodi }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        {{-- End section Jurusan --}}
                                        <button id="save" type="button" class="btn btn-success ms-1">
                                            <i class="bx bx-check d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Daftar</span>
                                        </button>
                                        <button class="btn btn-success spinner" id="loading" style="display: none;" type="button" disabled="">
                                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                            Loading...
                                        </button>
                                    </form>
                                </div>
                            </div>
                            {{-- <div class="card">
                                <div class="card-header">
                                    <h4>Silahkan Lakukan Pembayaran </h4>
                                </div>
                                <div class="card-body">
                                </div>
                            </div> --}}
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


    <script src="{{ asset('dist') }}/assets/extensions/apexcharts/apexcharts.min.js"></script>
    <script src="{{ asset('dist') }}/assets/static/js/pages/dashboard.js"></script>

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
</body>

</html>
