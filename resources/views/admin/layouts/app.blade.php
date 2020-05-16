<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    @include('admin/layouts/header')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  @include('admin/layouts/nav')

  @include('admin/layouts/sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid pt-5">

        @section('main')
            @show

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @include('admin/layouts/footer')

</body>
</html>
