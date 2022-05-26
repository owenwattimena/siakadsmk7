<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="http://siakad-smk-7.dev.test/assets/images/logo-smk-7.png" class="img-circle"
                    alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ \Auth::user()->name }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> {{ \Auth::user()->email }}</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        {{-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i
                            class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form> --}}
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            {{-- <li class="header">HEADER</li> --}}
            <!-- Optionally, you can add icons to the links -->
            @if (\Auth::user()->level_id == 1 ||  \Auth::user()->level_id == 2)
            <li class="{{ (request()->is('dashboard*')) ? 'active' : '' }}"><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            <li class="{{ (request()->is('visi-misi*')) ? 'active' : '' }}"><a href="{{ route('visi.misi') }}"><i class="fa fa-list"></i> <span>Visi & Misi</span></a></li>
            <li class="{{ (request()->is('galeri*')) ? 'active' : '' }}"><a href="{{ route('galeri') }}"><i class="fa fa-photo"></i> <span>Galeri</span></a></li>
            <li class="{{ (request()->is('jurusan*')) ? 'active' : '' }}"><a href="{{ route('jurusan.main') }}"><i class="fa fa-building"></i> <span>Jurusan</span></a></li>
            <li class="{{ (request()->is('kurikulum*')) ? 'active' : '' }}"><a href="{{ route('kurikulum.main') }}"><i class="fa fa-book"></i> <span>Kurikulum</span></a></li>
            <li class="{{ (request()->is('semester*')) ? 'active' : '' }}"><a href="{{ route('semester.main') }}"><i class="fa fa-calendar"></i> <span>Semester Akademik</span></a></li>
            <li class="{{ (request()->is('guru*')) ? 'active' : '' }}"><a href="{{ route('guru.main') }}"><i class="fa fa-user"></i> <span>Guru</span></a></li>
            <li class="{{ (request()->is('siswa*')) ? 'active' : '' }}"><a href="{{ route('siswa.main') }}"><i class="fa fa-users"></i> <span>Siswa</span></a></li>
            <li class="treeview {{ (request()->is('kelas*')) ? 'active' : '' }}">
                <a href="#"><i class="fa fa-list"></i> <span>Kelas</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ (request()->is('kelas/register-siswa*')) ? 'active' : '' }}"><a href="{{ route('kelas.register-siswa') }}"><i class="fa fa-circle-o"></i> <span>Register Siswa</span></a></li>
                    <li class="{{ (request()->is('kelas/register-kelas*')) ? 'active' : '' }}"><a href="{{ route('kelas.register-kelas') }}"><i class="fa fa-circle-o"></i> <span>Register Kelas Mapel</span></a></li>
                </ul>
            </li>
            <li class="treeview {{ (request()->is('nilai*')) ? 'active' : '' }}">
                <a href="#"><i class="fa fa-star"></i> <span>Hasil Studi</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ (request()->is('nilai/input-nilai*')) ? 'active' : '' }}"><a href="{{ route('nilai.input-nilai') }}"><i class="fa fa-circle-o"></i> <span>Input Nilai</span></a></li>
                </ul>
            </li>
            <li class="{{ (request()->is('saran*')) ? 'active' : '' }}"><a href="{{ route('saran') }}"><i class="fa fa-feed"></i> <span>Saran & Masukan</span></a></li>
            @elseif(\Auth::user()->level_id == 3)   
            <li class="{{ (request()->is('dashboard-guru')) ? 'active' : '' }}"><a href="{{ route('dashboard-guru') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            <li class="{{ (request()->is('visi-misi*')) ? 'active' : '' }}"><a href="{{ route('visi.misi') }}"><i class="fa fa-list"></i> <span>Visi & Misi</span></a></li>
            <li class="{{ (request()->is('galeri*')) ? 'active' : '' }}"><a href="{{ route('galeri') }}"><i class="fa fa-photo"></i> <span>Galeri</span></a></li>
            <li class="{{ (request()->is('dashboard-guru/kelas*')) ? 'active' : '' }}"><a href="{{ route('dashboard-guru.kelas') }}"><i class="fa fa-list"></i> <span>Kelas</span></a></li>
            @elseif(\Auth::user()->level_id == 4)   
            <li class="{{ (request()->is('dashboard-siswa')) ? 'active' : '' }}"><a href="{{ route('dashboard-siswa') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            <li class="{{ (request()->is('visi-misi*')) ? 'active' : '' }}"><a href="{{ route('visi.misi') }}"><i class="fa fa-list"></i> <span>Visi & Misi</span></a></li>
            <li class="{{ (request()->is('galeri*')) ? 'active' : '' }}"><a href="{{ route('galeri') }}"><i class="fa fa-photo"></i> <span>Galeri</span></a></li>
            <li class="{{ (request()->is('dashboard-siswa/tugas*')) ? 'active' : '' }}"><a href="{{ route('dashboard-siswa.tugas') }}"><i class="fa fa-book"></i> <span>Tugas</span></a></li>
            <li class="{{ (request()->is('dashboard-siswa/nilai*')) ? 'active' : '' }}"><a href="{{ route('dashboard-siswa.nilai') }}"><i class="fa fa-star"></i> <span>Nilai</span></a></li>
            <li class="{{ (request()->is('dashboard-siswa/saran*')) ? 'active' : '' }}"><a href="{{ route('dashboard-siswa.saran') }}"><i class="fa fa-feed"></i> <span>Saran & Masukan</span></a></li>
            @endif
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
