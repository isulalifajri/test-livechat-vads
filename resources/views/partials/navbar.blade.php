<nav
class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
id="layout-navbar">
<div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
  <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
    <i class="bx bx-menu bx-sm"></i>
  </a>
</div>

<div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
  <strong class="border-0 p-0" style="margin-top:3px">Dashboard</strong>
    
    <ul class="navbar-nav flex-row align-items-center ms-auto cursor-pointer nav-icon me-1">
    </ul>

    <ul class="navbar-nav flex-row align-items-center ms-2">

      <!-- User -->
      <li class="nav-item navbar-dropdown dropdown-user dropdown">
        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
          <div class="avatar avatar-online img-icons">
            <img src="{{ asset('no-images.jpg') }}" alt="profile" class="img-fluid rounded-circle" />
          </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
          <li>
            <a class="dropdown-item" href="#">
              <div class="d-flex">
                <div class="flex-shrink-0 me-3">
                  <div class="avatar avatar-online img-icons">
                    <img src="{{ asset('no-images.jpg') }}" alt class="img-fluid rounded-circle" />
                  </div>
                </div>
                <div class="flex-grow-1">
                  <span class="fw-medium d-block">{{ ucfirst(auth()->user()->name) }}</span>
                  <small class="text-muted">{{ auth()->user()->email }}</small>
                </div>
              </div>
            </a>
          </li>
          <li>
            <div class="dropdown-divider"></div>
          </li>
          <li>
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button type="submit" class="dropdown-item"><i class="bx bx-power-off me-2"></i>
                <span class="align-middle">Log Out</span></button>
            </form>
          </li>
        </ul>
      </li>
      <!--/ User -->
    </ul>
</div>
</nav>