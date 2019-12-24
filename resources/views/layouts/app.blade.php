<!DOCTYPE html>
<html lang="en">

<head>

  @include('partials.app._head')

</head>

<body>

<!-- App-->
  <div id="app">

    <!-- Wrapper-->
    <div class="d-flex" id="wrapper">

      <!-- Sidebar menu-->
      @include('partials.app._sidebar')

      <!-- Page Content -->
      <div id="page-content-wrapper">

        <!-- Navbar-->
        @include('partials.app._navbar')

        <!-- Main Content-->
        @yield('content')

      </div>
      <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

  </div>
  <!-- /#app -->

  <!-- JavaScripts -->
  @include('partials.app._javascripts')

</body>

</html>
