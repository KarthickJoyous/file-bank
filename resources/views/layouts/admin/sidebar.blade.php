<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a 
          class="nav-link {{request()->url() == route('admin.dashboard') ? '' : 'collapsed'}}" 
          href="{{route('admin.dashboard')}}"
        >
          <i class="bi bi-house"></i>
          <span>{{__('messages.admin.sidebar.home')}}</span>
        </a>
      </li><!-- End Home Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Components</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="components-alerts.html">
              <i class="bi bi-circle"></i><span>Alerts</span>
            </a>
          </li>
          <li>
            <a href="components-accordion.html">
              <i class="bi bi-circle"></i><span>Accordion</span>
            </a>
          </li>
        </ul>
      </li><!-- End Components Nav -->

      <li class="nav-item">
        <a 
          class="nav-link {{request()->url() == route('admin.profile') ? '' : 'collapsed'}}" 
          href="{{route('admin.profile')}}"
        >
          <i class="bi bi-person"></i>
          <span>{{__('messages.admin.sidebar.profile')}}</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a 
          class="nav-link collapsed" href="#"
          data-bs-toggle="modal" data-bs-target="#logoutModal"
        >
          <i class="bi bi-box-arrow-in-right"></i>
          <span>{{__('messages.admin.sidebar.logout')}}</span>
        </a>
      </li><!-- End Logout Page Nav -->

    </ul>

</aside>