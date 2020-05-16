 <!-- Main Footer -->
 <footer class="main-footer text-center">
    <strong>Copyright &copy; 2020 
      @if (Carbon\Carbon::now()->year > 2020)
        - {{ Carbon\Carbon::now()->year }}
      @endif 
    <a href="https://www.codingscript.in" target="blank">CodingScript</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('admin/main.js') }}"></script>

@section('footer')
    @show