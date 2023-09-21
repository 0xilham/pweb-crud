<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="{{ url('layout/home') }}" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('mhs/index') }}" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                    Mahasiswa
                    <i class="right fas fa-angle-right"></i>
                </p>
            </a>
        </li>
    </ul>
</nav>
