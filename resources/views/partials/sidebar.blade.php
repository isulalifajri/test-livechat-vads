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

    

      <!-- Layouts -->
      <li class="menu-item {{ Request::is('chat*') ? 'active' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-layout"></i>
          <div data-i18n="Data Master">Chat</div>
        </a>
  
        <ul class="menu-sub">
          <li class="menu-item  {{ Request::is('chat/livechat*') ? 'active' : '' }}">
            <a href="{{ route('chat.livechat') }}" class="menu-link">
              <div data-i18n="livechat">Livechat</div>
            </a>
          </li>
        </ul>

      </li>
      
    </ul>
  </aside>