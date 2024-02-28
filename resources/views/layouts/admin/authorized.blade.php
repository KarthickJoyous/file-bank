<!-- ======= Header ======= -->
@include('layouts.admin.header')
<!-- End Header -->

<!-- ======= Sidebar ======= -->
@include('layouts.admin.sidebar')
<!-- End Sidebar-->

<!-- ======= #Main ======= -->
<main id="main" class="main">

<!-- ======= Page Title ======= -->
  <div class="pagetitle">
    <h1>@yield('title')</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        @yield('breadcrumn')
      </ol>
    </nav>
  </div>
<!-- End Page Title -->

@yield('note')

@yield('content')

</main>
<!-- End #main -->

<!-- ======= Footer ======= -->
@include('layouts.admin.footer')
<!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center">
<i class="bi bi-arrow-up-short"></i>
</a>