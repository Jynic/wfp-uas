<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ request()->segment(1) == '' ? '' : 'collapsed' }}" href="/">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link {{ request()->segment(1) == 'provinsi' ? '' : 'collapsed' }} {{ request()->segment(1) == 'kota' ? '' : 'collapsed' }} {{ request()->segment(1) == 'dinas' ? '' : 'collapsed' }} {{ request()->segment(1) == 'jenisfasum' ? '' : 'collapsed' }} {{ request()->segment(1) == 'fasum' ? '' : 'collapsed' }} {{ request()->segment(1) == 'staff' ? '' : 'collapsed' }} {{ request()->segment(1) == 'user' ? '' : 'collapsed' }}"
                data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Master</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav"
                class="nav-content collapse {{ request()->segment(1) == 'provinsi' ? 'show' : '' }} {{ request()->segment(1) == 'kota' ? 'show' : '' }} {{ request()->segment(1) == 'dinas' ? 'show' : '' }} {{ request()->segment(1) == 'jenisfasum' ? 'show' : '' }} {{ request()->segment(1) == 'fasum' ? 'show' : '' }} {{ request()->segment(1) == 'staff' ? 'show' : '' }} {{ request()->segment(1) == 'user' ? 'show' : '' }}"
                data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('provinsi') }}"
                        class="{{ request()->segment(1) == 'provinsi' ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Provinsi</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('kota') }}" class="{{ request()->segment(1) == 'kota' ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Kota</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('dinas') }}" class="{{ request()->segment(1) == 'dinas' ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Dinas</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('jenisfasum') }}"
                        class="{{ request()->segment(1) == 'jenisfasum' ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Jenis Fasilitas Umum</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('fasum') }}" class="{{ request()->segment(1) == 'fasum' ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Fasilitas Umum</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('staff') }}" class="{{ request()->segment(1) == 'staff' ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Staff</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('user') }}" class="{{ request()->segment(1) == 'user' ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>User</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Components Nav -->

        <li class="nav-item">
            <a class="nav-link {{ request()->segment(1) == 'pelaporan' ? '' : 'collapsed' }} {{ request()->segment(1) == 'pelaporanadmin' ? '' : 'collapsed' }}"
                data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Transaksi</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav"
                class="nav-content collapse {{ request()->segment(1) == 'pelaporan' ? 'show' : '' }} {{ request()->segment(1) == 'pelaporanadmin' ? 'show' : '' }}"
                data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('pelaporan') }}"
                        class="{{ request()->segment(1) == 'pelaporan' ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Pelaporan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('pelaporanadmin') }}"
                        class="{{ request()->segment(1) == 'pelaporanadmin' ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Pelaporan Admin</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->segment(1) == 'historypelaporan' ? '' : 'collapsed' }}"
                data-bs-target="#report-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Report</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="report-nav"
                class="nav-content collapse {{ request()->segment(1) == 'historypelaporan' ? 'show' : '' }}"
                data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('historypelaporan') }}"
                        class="{{ request()->segment(1) == 'historypelaporan' ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>History Perbaikan</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#setting-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Setting</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="setting-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('hakakses') }}">
                        <i class="bi bi-circle"></i><span>Hak Akses</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>

</aside>
