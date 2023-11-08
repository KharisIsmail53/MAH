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
                    <li class="{{ Request::is('dashboard-bmm') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('dashboard-bmm') }}">Dashboard Utama</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown {{ $type_menu === 'inventaris' ? 'active' : '' }}">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fa-solid fa-boxes-stacked"></i><span>Baitul Maal</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('inventaris') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('dashboard-kkw') }}">Daftar Inventaris Infaq</a>
                    </li>
                    <li class="{{ Request::is('tambah-inventaris') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ url('tambah-inventaris-kkw') }}">Tambah Baitul Maal</a>
                    </li>
                </ul>
            </li>
        </ul>
    </aside>
</div>
