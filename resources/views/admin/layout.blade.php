<!DOCTYPE html>
<html lang="en">
    @include('admin.partials.head')
<body>
  <section id="container">
    @include('admin.partials.header')
    @include('admin.partials.sidebar')
        
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        @yield('content')
        <!-- /row -->
      </section>
    </section>
    <!--main content end-->
    
  </section>
    @include('admin.partials.scripts')
  
  <script class="include" type="text/javascript" src="lib/jquery.dcjqaccordion.2.7.js"></script>
  <script src="lib/jquery.scrollTo.min.js"></script>
  <script src="lib/jquery.nicescroll.js" type="text/javascript"></script>
  <!--common script for all pages-->
  <script src="lib/common-scripts.js"></script>
</body>

</html>
