  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #c18046;">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('assets/img/logo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Kabul Silo MIS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      @auth
  <!-- Sidebar user panel (optional) -->
  <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
      <img src="{{ asset('assets/img/logo.png') }}" class="img-circle elevation-2" alt="User Image">
    </div>
    <div class="info">
      <a href="#" class="d-block">
        {{ Auth::user()->username }}
      </a>
    </div>
  </div>
@endauth
      <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                     <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link">
                            <i class="fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                    <a href="{{ route('view-sliders') }}" class="nav-link">
                        <i class="fas fa-sliders-h"></i>
                        <p>
                            Slider Management
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('view-sliders') }}" class="nav-link">
                                <i class="fas fa-eye"></i>
                                <p>View Slides</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('add-sliders') }}" class="nav-link">
                                <i class="fas fa-plus"></i>
                                <p>Add Sliders</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('view-biography') }}" class="nav-link">
                        <i class="fas fa-user"></i>
                        <p>
                            Biography Management
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('view-biography') }}" class="nav-link">
                                <i class="fas fa-eye"></i>
                                <p>View Biography</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('view-information') }}" class="nav-link">
                        <i class="fas fa-info-circle"></i>
                        <p>
                            Information Management
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('view-information') }}" class="nav-link">
                                <i class="fas fa-eye"></i>
                                <p>View Information</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('view-information') }}" class="nav-link">
                        <i class="fas fa-newspaper"></i>
                        <p>
                            News Management
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                    <li class="nav-item">
                            <a href="{{ route('view-news') }}" class="nav-link">
                                <i class="fas fa-newspaper"></i>
                                <p>View News</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('view-add-news') }}" class="nav-link">
                                <i class="fas fa-plus-circle"></i>
                                <p>Add News</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('view-gallery') }}" class="nav-link">
                        <i class="fas fa-images"></i>
                        <p>
                            Gallery Management
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                    <li class="nav-item">
                            <a href="{{ route('view-gallery') }}" class="nav-link">
                                <i class="fas fa-images"></i>
                                <p>View Gallery</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('create-gallery') }}" class="nav-link">
                                <i class="fas fa-plus-circle"></i>
                                <p>Add Gallery</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('view-users') }}" class="nav-link">
                        <i class="fas fa-user"></i>
                        <p>
                            Users Management
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('view-users') }}" class="nav-link">
                                <i class="fas fa-eye"></i>
                                <p>View Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('add-user-page') }}" class="nav-link">
                                <i class="fas fa-plus-circle"></i>
                                <p>Add Users</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- Logout Section -->
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i>
                    <p>
                        Logout
                    </p>
                </a>
            </li>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </ul>
    </div>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
