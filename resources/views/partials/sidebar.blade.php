  <!-- Main Sidebar Container -->
  <aside style="background-color: #333533" class="main-sidebar sidebar-dark-secondary elevation-4">
    <!-- Brand Logo -->
    <a href="/dashboard" class="brand-link">
      <img src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{ Auth::user()->name }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{route('patients.index')}}" class="nav-link {{ (request()->is('patients*')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-virus"></i>
              <p>
                Patients
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link {{ (request()->is('payments*')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-money-bill"></i>
              <p>
                Payments
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('officers.index')}}" class="nav-link {{ (request()->is('officers*')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-user-nurse"></i>
              <p>
                Health Officers
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('hospitals.index')}}" class="nav-link {{ (request()->is('hospitals*')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-hospital"></i>
              <p>
                Hospitals
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="{{route('districts.index')}}" class="nav-link {{ (request()->is('districts*')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-map-marker"></i>
              <p>
                Districts
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="admin" class="nav-link {{ (request()->is('admin*')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-clipboard"></i>
              <p>
                Admininstration
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>