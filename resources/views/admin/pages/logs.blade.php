@extends('admin.layout')
@section('content')
<h3><i class="fa fa-angle-right"></i> Print Logs</h3>
        <button onclick="printDiv('printable')">Print</button>
        <div class="row">
          <div class="col-md-12 mt" id="printable">
            <div class="content-panel">
              <table class="table table-hover">
                <h4><i class="fa fa-angle-right"></i> </h4>
                <hr>
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>Client</th>
                    <th>Pages</th>
                    <th>Type</th>
                    <th>Size</th>
                    <th>Copies</th>
                    <th>Credits</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
          <!-- /col-md-12 -->
        </div>
        </div>
        <!-- /row -->
@endsection

@push('scripts')
<script>
    function printDiv(divID) {
      var divElem = document.getElementById(divID).innerHTML;
      var printWindow = window.open('', '',); 
      printWindow.document.write(
`<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
  <title>Dashio - Bootstrap Admin Template</title>

  <!-- Favicons -->
  <link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Bootstrap core CSS -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">
  
  <!-- =======================================================
    Template Name: Dashio
    Template URL: https://templatemag.com/dashio-bootstrap-admin-template/
    Author: TemplateMag.com
    License: https://templatemag.com/license/
  ======================================================= -->
</head>`);
      printWindow.document.write('<html>');
      printWindow.document.write('<h1>Print Logs</h1>');
      printWindow.document.write('<body>');
      printWindow.document.write(divElem);
      printWindow.document.write('</body>');
      printWindow.document.write ('</html>');
      printWindow.document.close();
      printWindow.print();
    }
  </script>
@endpush