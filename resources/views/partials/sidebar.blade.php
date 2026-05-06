<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
      <a href="" class="app-brand-link">
        <span class="app-brand-logo demo img-icons">
          <img src="{{ asset('vads.png') }}" 
               alt="default" 
               class="img-fluid h-100">
        </span>
        <span class="app-brand-text demo menu-text fw-bold ms-2">LiveChat</span>
      </a>
  
      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
        <i class="bx bx-chevron-left bx-sm align-middle"></i>
      </a>
    </div>
  
    <div class="menu-inner-shadow"></div>
  
    <ul class="menu-inner py-1">
      <!-- Dashboards -->
      <li class="menu-item {{ Request::is('dashboard') ? 'active' : '' }}">
        <a href="{{ route('dashboard') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-home-circle"></i>
          <div data-i18n="Dashboards">Dashboards</div>
        </a>
      </li>

    

      <li class="menu-item {{ Request::segment(1) === 'approval' ? 'active' : '' }}">
        <a href="" class="menu-link">
          <i class="menu-icon tf-icons bx bx-collection"></i>
          <div data-i18n="Persetujuan">Persetujuan</div>
        </a>
      </li>
      
    </ul>
  </aside>