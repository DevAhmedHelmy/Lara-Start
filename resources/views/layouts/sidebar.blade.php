<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="./img/logo.png" alt="LaraStart Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">LaraStart</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      @if(Auth::check())
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="./img/man.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">
            {{Auth::user()->name}}
          </a>
        </div>
        @endif
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
			   with font-awesome or any other icon font library -->
			   <li class="nav-item">
				<router-link to="/dashboard" class="nav-link">
				  <i class="nav-icon fas fa-tachometer-alt blue"></i>
				  <p>
					    Dashboard
				  </p>
				</router-link>
			  </li>
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cog green"></i>
              <p>
                Management
                <i class="right fas fa-angle-left "></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link to="/users" class="nav-link">
                  <i class="nav-icon fas fa-users orange"></i>
                  <p>
                  Users
          
                  </p>
                </router-link>
                </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-circle nav-icon"></i>
                  <p>Inactive Page</p>
                </a>
              </li>
            </ul>
          </li>
          
          <li class="nav-item">
          <router-link to="/developer" class="nav-link">
            <i class="nav-icon fas fa-user orange"></i>
            <p>
            Developer

            </p>
          </router-link>
          </li>
      
      <li class="nav-item">
			<router-link to="/profile" class="nav-link">
			  <i class="nav-icon fas fa-user orange"></i>
			  <p>
				Profile

			  </p>
			</router-link>
		  </li>
		  
          <li class="nav-item">            
                <a class="nav-link" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-power-off red"></i>
                    <p>{{ __('Logout') }}</p>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
             </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
