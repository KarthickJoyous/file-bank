<!-- ======= Header ======= -->
@include('layouts.user.header')
<!-- End Header -->

<!-- ======= Sidebar ======= -->
@include('layouts.user.sidebar')
<!-- End Sidebar-->

<!-- ======= #Main ======= -->
<main id="main" class="main">

<!-- ======= Page Title ======= -->
  <div class="pagetitle">
    <h1>@yield('title')</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('user.dashboard')}}">{{__('messages.user.home.title')}}</a></li>
        @yield('breadcrumb')
      </ol>
    </nav>
  </div>
<!-- End Page Title -->

@yield('note')

@yield('content')

</main>
<!-- End #main -->

<!-- ======= Footer ======= -->
@include('layouts.user.footer')
<!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center">
  <i class="bi bi-arrow-up-short"></i>
</a>