  <footer class="text-center text-white bg-purple pt-3 pb-3">Copyright &copy; {{ \Carbon\Carbon::now()->year }} Coursenta</footer>

</div>

  <script src="{{ asset('/js/jquery-3.1.0.min.js') }}"></script>
  <script src="{{ asset('/js/popper.min.js') }}"></script>
  <script src="{{ asset('/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('/js/mdb.min.js') }}"></script>
  <script src="{{ asset('/js/sidebar.min.js') }}"></script>
  <script src="{{ asset('/js/sidebar.js') }}"></script>
  <script src="{{ asset('/js/jquery.nicescroll.min.js') }}"></script>
  <script>
  	$("body").niceScroll({cursorcolor:"#A028BF"});
    $(".has-error input").removeClass('valid').addClass('invalid');
    $('.has-error label').after().width($(this).width());
    $('.has-error input[type="password"]').attr("autofocus", "autofocus");
  </script>
