<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('/dashboard')}}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">{{ env('APP_NAME') }} <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    @if (Auth::user()->role == 'owner')
    <li class="nav-item active">
        <a class="nav-link" href="{{url('/dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    @elseif(Auth::user()->role == 'wh1')
    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{url('/dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Nav Item - Data -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ url('/benang-datang') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Benang Datang</span></a>
    </li>

    <!-- Nav Item - Data -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ url('/produksi-lembaran') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Produksi Lembaran</span></a>
    </li>

    <!-- Nav Item - Data -->
    {{-- <li class="nav-item active">
        <a class="nav-link" href="{{ url('/sarung') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Sarung</span></a>
    </li> --}}


    <li class="nav-item active">
        <a class="nav-link" href="{{ url('/kirim-barang/napes') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Kirim Ke Bandaran</span></a>
    </li>
    @elseif(Auth::user()->role == 'wh2')
    <li class="nav-item active">
        <a class="nav-link" href="{{url('/dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Managemen Data
    </div>

    {{-- <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Components</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Components:</h6>
                <a class="collapse-item" href="buttons.html">Buttons</a>
                <a class="collapse-item" href="cards.html">Cards</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Utilities</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Utilities:</h6>
                <a class="collapse-item" href="utilities-color.html">Colors</a>
                <a class="collapse-item" href="utilities-border.html">Borders</a>
                <a class="collapse-item" href="utilities-animation.html">Animations</a>
                <a class="collapse-item" href="utilities-other.html">Other</a>
            </div>
        </div>
    </li> --}}

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true"
            aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Managemen Data</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Managemen Data :</h6>
                {{-- <a class="collapse-item" href="{{url('/jenis-benang')}}">Jenis Benang</a> --}}
                <a class="collapse-item" href="{{url('/warna')}}">Warna</a>
                {{-- <a class="collapse-item" href="{{url('/satuan')}}">Satuan</a> --}}
                <a class="collapse-item" href="{{url('/mesin')}}">Mesin</a>
                <a class="collapse-item" href="{{url('/shift-kerja')}}">Shift Kerja</a>
                <h6 class="collapse-header">Data Sarung:</h6>
                <a class="collapse-item" href="{{url('/motif-sarung')}}">Motif</a>

                {{-- <a class="collapse-item" href="{{url('/kategori-barang')}}">Kategori Barang</a>
                <a class="collapse-item" href="{{url('/satuan-barang')}}">Satuan Barang</a>
                <a class="collapse-item" href="register.html">Register</a>
                <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Other Pages:</h6>
                <a class="collapse-item" href="404.html">404 Page</a>
                <a class="collapse-item" href="blank.html">Blank Page</a> --}}
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Management Account
    </div>

    <!-- Account -->
    {{-- <li class="nav-item">
        <a class="nav-link" href="{{ url('/profile') }}">
            <i class="fas fa-user"></i>
            <span> Profile</span>
        </a>
    </li> --}}
    <li class="nav-item">
        <a class="nav-link" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt"></i>
            Logout
        </a>
    </li>




    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
