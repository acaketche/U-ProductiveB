<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" aria-current="page" href="{{route('admin.dashboard')}}">
                    <span data-feather="home"></span>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <x-navbar.nav-item1 route="kelola.user" text="Kelola Data User" icon="users"/>
            </li>
            <li class="nav-item">
                <x-navbar.nav-item1 route="kelola.kategori" text="Kelola Data Kategori" icon="tag"/>
            </li>
            <li class="nav-item">
                <x-navbar.nav-item1 route="kelola.artikel" text="Kelola Data Artikel" icon="file-text"/>
            </li>
            <li class="nav-item">
                <x-navbar.nav-item1 route="kelola.video" text="Kelola Data Video" icon="video"/>
            </li>
            <li class="nav-item">
                <x-navbar.nav-item1 route="kelola.forum" text="Kelola Data Forum" icon="message-circle"/>
            </li>
        </ul>
    </div>
</nav>
