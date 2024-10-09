<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('dashboard*') ? 'active' : '' }}"
                href="{{ url('/admin/dashboard') }}"
                style="{{ request()->routeIs('dashboard*') ? 'color: #007bff; font-weight: bold;' : '' }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('categories*') ? 'active' : '' }}"
                href="{{ route('categories.index') }}"
                style="{{ request()->routeIs('categories*') ? 'color: #007bff; font-weight: bold;' : '' }}">
                <i class="bi bi-menu-button-wide"></i>
                <span>Categories</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('products*') ? 'active' : '' }}"
                href="{{ route('products.index') }}"
                style="{{ request()->routeIs('products*') ? 'color: #007bff; font-weight: bold;' : '' }}">
                <i class="bi bi-journal-text"></i>
                <span>Products</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('discounts.*') ? 'active' : '' }}"
                href="{{ route('discounts.index') }}" style="color:black;">
                <i class="bi bi-layout-text-window-reverse"></i>
                <span>Discounts</span>
            </a>
        </li>


        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('orders*') ? 'active' : '' }}" href="{{ route('orders.index') }}"
                style="{{ request()->routeIs('orders*') ? 'color: #007bff; font-weight: bold;' : '' }}">
                <i class="bi bi-bar-chart"></i>
                <span>Orders</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#"
                style="color:black;">
                <i class="bi bi-gem"></i>
                <span>Settings</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="icons-nav" class="nav-content collapse {{ request()->routeIs('contactus.*') ? 'show' : '' }}"
                data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('contactus.index') }}"
                        class="{{ request()->routeIs('contactus.*') ? 'active' : '' }}"
                        style="{{ request()->routeIs('contactus.*') ? 'color: #007bff; font-weight: bold;' : '' }}">
                        <i class="bi bi-circle"></i>
                        <span>Contact US</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <a class="nav-link" href="#"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                style="{{ request()->routeIs('logout.*') ? 'color: #007bff; font-weight: bold;' : '' }}">
                <i class="bi bi-box-arrow-in-right"></i>
                <span>Logout</span>
            </a>
        </li>

    </ul>
</aside>
