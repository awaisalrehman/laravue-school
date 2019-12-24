<!-- Essential javascripts for application to work
  Bootstrap core JavaScript -->
<script src="{{ asset('/simple_sidebar/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('/simple_sidebar/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>


<script src="{{ asset('js/app.js') }}"></script>

<!-- Page specific javascripts-->
@yield('scripts')

<!-- Menu Toggle Script -->
<script>
  $("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
  });
</script>
