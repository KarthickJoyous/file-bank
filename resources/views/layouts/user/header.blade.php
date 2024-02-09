<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="@setting('app_logo')" 
        alt="@setting('app_name')">
        <span class="d-none d-lg-block">@setting('app_name')</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="{{auth('web')->user()->avatar ?: asset('assets/placegolders/user/avatar.png')}}" 
            alt="{{auth('web')->user()->name}}" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">
              {{auth('web')->user()->name}}
            </span>
          </a><!-- End Profile Image Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>{{auth('web')->user()->name}}</h6>
              <span>{{auth('web')->user()->email}}</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{route('user.profile')}}">
                <i class="bi bi-person"></i>
                <span>{{__('messages.user.header.profile')}}</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a 
                class="dropdown-item d-flex align-items-center" href="#"
                data-bs-toggle="modal" data-bs-target="#logoutModal">
                <i class="bi bi-box-arrow-right"></i>
                <span>{{__('messages.user.header.logout')}}</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

</header>

<div class="modal fade" id="logoutModal" tabindex="-1" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{__('messages.user.logout.title')}} ?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        {{__('messages.user.logout.logout_confirmation')}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          {{__('messages.user.logout.cancel')}}
        </button>
        <button 
          type="button" 
          class="btn btn-primary" 
          onclick="
          this.disabled=true; 
          this.innerHTML='{{__("messages.user.logout.submit_btn_loading_text")}}';
          document.getElementById('logoutForm').submit();"
          >
          {{__('messages.user.logout.title')}}
        </button>
        <form class="d-none" method="POST" id="logoutForm" action="{{route('user.logout')}}">
          @csrf
        </form>
      </div>
    </div>
  </div>
</div>