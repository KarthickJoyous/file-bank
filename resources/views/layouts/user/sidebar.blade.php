<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a 
          class="nav-link {{request()->url() == route('user.dashboard') ? '' : 'collapsed'}}" 
          href="{{route('user.dashboard')}}"
        >
          <i class="bi bi-house"></i>
          <span>{{__('messages.user.sidebar.home')}}</span>
        </a>
      </li><!-- End Home Nav -->

      {{--<li class="nav-item">
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
      </li><!-- End Components Nav -->--}}

      <li class="nav-item">
        <a 
          class="nav-link {{request()->is('folders') || request()->is('folders/*') ? '' : 'collapsed'}}" 
          href="{{route('user.folders.index')}}"
        >
          <i class="bi bi-folder"></i>
          <span>{{__('messages.user.sidebar.folders')}}</span>
        </a>
      </li><!-- End Folders Nav -->

      <li class="nav-item">
        <a 
          class="nav-link {{request()->is('files') || request()->is('files/*') ? '' : 'collapsed'}}" 
          href="{{route('user.files.index')}}"
        >
          <i class="bi bi-file-earmark"></i>
          <span>{{__('messages.user.sidebar.files')}}</span>
        </a>
      </li><!-- End Files Nav -->

      <li class="nav-item">
        <a 
          class="nav-link {{request()->url() == route('user.profile') ? '' : 'collapsed'}}" 
          href="{{route('user.profile')}}"
        >
          <i class="bi bi-person"></i>
          <span>{{__('messages.user.sidebar.profile')}}</span>
        </a>
      </li><!-- End Profile Nav -->

      <li class="nav-item">
        <a 
          class="nav-link collapsed" href="#"
          data-bs-toggle="modal" data-bs-target="#logoutModal"
        >
          <i class="bi bi-box-arrow-in-right"></i>
          <span>{{__('messages.user.sidebar.logout')}}</span>
        </a>
      </li><!-- End Logout Nav -->
      <li class="nav-item text-center">
        <div class="progress mt-3">
          <div 
            class="progress-bar"
            role="progressbar"
            style="width: {{auth('web')->user()->passbook->used * 100 / auth('web')->user()->passbook->total}}%"
            aria-valuemin="0"
            aria-valuemax="{{auth('web')->user()->passbook->total}}"
            aria-valuenow="{{auth('web')->user()->passbook->used}}"
            data-bs-toggle="tooltip" 
            data-bs-placement="top" 
            data-bs-original-title="{{(new App\Helpers\viewHelper)->formatted_storage_size(auth('web')->user()->passbook->used)}} Used"
          ></div>
        </div>
        <p class="my-3">Remaining {{(new App\Helpers\viewHelper)->formatted_storage_size(auth('web')->user()->passbook->remaining)}} of {{(new App\Helpers\viewHelper)->formatted_storage_size(auth('web')->user()->passbook->total)}}</p>
      </li><!-- End Storage Nav -->

    </ul>

</aside>