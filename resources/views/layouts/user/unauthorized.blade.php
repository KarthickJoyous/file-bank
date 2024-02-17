<!-- ======= #Main ======= -->
<main>
  <div class="container">
    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

            <!-- Logo -->
            <div class="d-flex justify-content-center py-4">
              <a href="{{route('user.dashboard')}}" class="logo d-flex align-items-center w-auto">
                <img src="@setting('app_logo')" alt="">
                <span class="d-none d-lg-block">@setting('app_name')</span>
              </a>
            </div>
            <!-- End Logo -->

            <div class="card mb-3">

              <div class="card-body">

                @yield('content')

              </div>
            </div>

            <div class="copyright footer">
              &copy; Copyright {{date('Y')}} <strong><span>@setting('app_name')</span></strong>. All Rights Reserved
            </div>
            {{--
              <div class="credits">
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
              </div>
            --}}
          </div>
        </div>
      </div>
    </section>
  </div>
</main>
<!-- End #main -->