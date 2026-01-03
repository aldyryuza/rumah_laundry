<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="{{ asset('img/laundry.jpg') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">RUMAH LAUNDRY</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">MENU</li>
                @if (Auth::user()->role == 'pelanggan')
                <li class="nav-item">
                    <a href="{{ url('orders') }}" class="nav-link {{ Request::is('orders*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>Order Laundry</p>
                    </a>
                </li>
                @elseif (Auth::user()->role == 'admin')
                <li class="nav-item">
                    <a href="{{ url('dashboard') }}" class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-columns"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('users') }}" class="nav-link {{ Request::is('users*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Users</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('laundry-types') }}"
                        class="nav-link {{ Request::is('laundry-types*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-soap"></i>
                        <p>Tipe Laundry</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('laundry-packages') }}"
                        class="nav-link {{ Request::is('laundry-packages*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-box"></i>
                        <p>Paket Laundry</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('orders') }}" class="nav-link {{ Request::is('orders*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>Order Laundry</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-bar"></i>
                        <p>
                            Laporan
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('reports.orders') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Order Report</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('reports.payments') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Payment Report</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('reports.invoices') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Invoice Report</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @elseif(Auth::user()->role == 'owner')
                <li class="nav-item">
                    <a href="{{ url('dashboard') }}" class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-columns"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('users') }}" class="nav-link {{ Request::is('users*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Users</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-bar"></i>
                        <p>
                            Reports
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('reports.orders') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Order Report</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('reports.payments') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Payment Report</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('reports.invoices') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Invoice Report</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                {{-- logout --}}
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        {{ csrf_field() }}
                    </form>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>