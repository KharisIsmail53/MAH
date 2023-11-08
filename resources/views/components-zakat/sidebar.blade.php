<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item dropdown {{ $type_menu === 'dashboard' ? 'active' : '' }}">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('dashboard-zakat') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('dashboard-zakat') }}">Dashboard Utama</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown {{ $type_menu === 'inventaris' ? 'active' : '' }}">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fa-solid fa-wheat-awn"></i><span>Stock Beras</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('inventaris') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('stock-beras') }}">Daftar Stock Beras</a>
                    </li>
                    <li class="{{ Request::is('tambah-inventaris') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('tambah-inventaris-kkw') }}">Tambah Stock Beras</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown {{ $type_menu === 'keanggotaan' ? 'active' : '' }}">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fa-solid fa-handshake-simple"></i><span>Transaksi Zakat</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('keanggotaan') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('dashboard-kkw') }}">Daftar Keanggotaan</a>
                    </li>
                    <li class="{{ Request::is('tambah-keanggotaan') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('tambah-anggota-kkw') }}">Tambah Anggota KKW</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown {{ $type_menu === 'keanggotaan' ? 'active' : '' }}">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fa-solid fa-users"></i><span>Amil Zakat</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('keanggotaan') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('dashboard-kkw') }}">Daftar Amil Zakat</a>
                    </li>
                    <li class="{{ Request::is('tambah-keanggotaan') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('tambah-anggota-kkw') }}">Tambah Amil Zakat</a>
                    </li>
                </ul>
            </li>
        </ul>
    </aside>
</div>
