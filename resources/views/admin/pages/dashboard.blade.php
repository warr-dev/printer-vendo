@extends('admin.layout')
@section('content')
<div class="row">
  <div class="col-lg-9 main-chart">
    <!--CUSTOM CHART START -->
    <div class="border-head">
      <h3>USER VISITS</h3>
    </div>

    <!--custom chart end-->
    <div class="row mt">
      <!-- SERVER STATUS PANELS -->
      <!--/ col-md-3 -->
      <div class="col-md-3 col-sm-3 mb">
        <div class="green-panel pn">
          <div class="green-header">
            <h5>CLIENTS</h5>
          </div>
          <canvas id="serverstatus03" height="120" width="120"></canvas>
          <script>
            var doughnutData = [{
                value: 60,
                color: "#2b2b2b"
              },
              {
                value: 40,
                color: "#fffffd"
              }
            ];
            var myDoughnut = new Chart(document.getElementById("serverstatus03").getContext("2d")).Doughnut(doughnutData);
          </script>
          <h3> clients</h3>
        </div>
      </div>
      <div class="col-md-3 col-sm-3 mb">
        <div class="grey-panel pn donut-chart">
          <div class="grey-header">
            <h5>PAGES PRINTED</h5>
          </div>
          <canvas id="serverstatus01" height="120" width="120"></canvas>
          <script>
            var doughnutData = [{
                value: 70,
                color: "#FF6B6B"
              },
              {
                value: 30,
                color: "#fdfdfd"
              }
            ];
            var myDoughnut = new Chart(document.getElementById("serverstatus01").getContext("2d")).Doughnut(doughnutData);
          </script>
          <h3> pages</h3>
        </div>
        <!-- /grey-panel -->
      </div>
      <!-- /col-md-3-->
      <div class="col-md-3 col-sm-3 mb">
        <div class="darkblue-panel pn">
          <div class="darkblue-header">
            <h5>INCOME TODAY</h5>
          </div>
          <canvas id="serverstatus02" height="120" width="120"></canvas>
          <script>
            var doughnutData = [{
                value: 60,
                color: "#1c9ca7"
              },
              {
                value: 40,
                color: "#f68275"
              }
            ];
            var myDoughnut = new Chart(document.getElementById("serverstatus02").getContext("2d")).Doughnut(doughnutData);
          </script>
          <p>date('F j, Y')</p>
          <footer>
            <h3>PHP creds</h3>
          </footer>
        </div>
        <!--  /darkblue panel -->
      </div>
      <!-- /col-md-3 -->
      <div class="col-md-3 col-sm-3 mb">
        <!-- REVENUE PANEL -->
        <div class="green-panel pn">
          <div class="green-header">
            <h5>REVENUE</h5>
          </div>
          <div class="chart mt">
            <div class="sparkline" data-type="line" data-resize="true" data-height="75" data-width="90%" data-line-width="1" data-line-color="#fff" data-spot-color="#fff" data-fill-color="" data-highlight-line-color="#fff" data-spot-radius="4" data-data="[200,135,667,333,526,996,564,123,890,464,655]"></div>
          </div>
          <p class="mt"><b>PHP </b><br /> Month Income</p>
        </div>
      </div>
      <!-- /col-md-3 -->

      <div class="col-md-12 col-sm-12 mb">
        <!-- REVENUE PANEL -->
        <div class="green-panel pn">
          <div class="green-header">
            <h5>REVENUE</h5>
          </div>
          <!-- page start-->
          <div class="content-panel">
            <h4><i class="fa fa-angle-right"></i> Showing Monthly Sales</h4>
            <div class="panel-body">
              <figure class="demo-xchart" id="chart"></figure>
            </div>
          </div>
          <!-- page end-->
        </div>
      </div>
    </div>


    <!-- <div class="custom-bar-chart">
              <ul class="y-axis">
                <li><span>10.000</span></li>
                <li><span>8.000</span></li>
                <li><span>6.000</span></li>
                <li><span>4.000</span></li>
                <li><span>2.000</span></li>
                <li><span>0</span></li>
              </ul>
              <div class="bar">
                <div class="title">JAN</div>
                <div class="value tooltips" data-original-title="8.500" data-toggle="tooltip" data-placement="top">85%</div>
              </div>
              <div class="bar ">
                <div class="title">FEB</div>
                <div class="value tooltips" data-original-title="5.000" data-toggle="tooltip" data-placement="top">50%</div>
              </div>
              <div class="bar ">
                <div class="title">MAR</div>
                <div class="value tooltips" data-original-title="6.000" data-toggle="tooltip" data-placement="top">60%</div>
              </div>
              <div class="bar ">
                <div class="title">APR</div>
                <div class="value tooltips" data-original-title="4.500" data-toggle="tooltip" data-placement="top">45%</div>
              </div>
              <div class="bar">
                <div class="title">MAY</div>
                <div class="value tooltips" data-original-title="3.200" data-toggle="tooltip" data-placement="top">32%</div>
              </div>
              <div class="bar ">
                <div class="title">JUN</div>
                <div class="value tooltips" data-original-title="6.200" data-toggle="tooltip" data-placement="top">62%</div>
              </div>
              <div class="bar">
                <div class="title">JUL</div>
                <div class="value tooltips" data-original-title="7.500" data-toggle="tooltip" data-placement="top">75%</div>
              </div>
            </div> -->
    <!-- /row -->
  </div>
  <!-- /col-lg-9 END SECTION MIDDLE -->
  <!-- **********************************************************************************************************************************************************
              RIGHT SIDEBAR CONTENT
              *********************************************************************************************************************************************************** -->
  <div class="col-lg-3 ds">
    <!--COMPLETED ACTIONS DONUTS CHART-->
    <div class="donut-main">
      <h4>COMPLETED ACTIONS & PROGRESS</h4>
      <canvas id="newchart" height="130" width="130"></canvas>
      <script>
        var doughnutData = [{
            value: 70,
            color: "#4ECDC4"
          },
          {
            value: 30,
            color: "#fdfdfd"
          }
        ];
        var myDoughnut = new Chart(document.getElementById("newchart").getContext("2d")).Doughnut(doughnutData);
      </script>
    </div>
    <!--NEW EARNING STATS -->
    <div class="panel terques-chart">
      <div class="panel-body">
        <div class="chart">
          <div class="centered">
            <span>TOTAL EARNINGS</span>
            <strong>PHP </strong>
          </div>
          <br>
          <div class="sparkline" data-type="line" data-resize="true" data-height="75" data-width="90%" data-line-width="1" data-line-color="#fff" data-spot-color="#fff" data-fill-color="" data-highlight-line-color="#fff" data-spot-radius="4" data-data="[200,135,667,333,526,996,564,123,890,564,455]"></div>
        </div>
      </div>
    </div>
    <!--new earning end-->
    <!-- RECENT ACTIVITIES SECTION -->
    <h4 class="centered mt">RECENT ACTIVITY</h4>
    <!-- First Activity -->
    <div class="desc">
      <div class="thumb">
        <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
      </div>
      <div class="details">
        <p>
          <!-- <muted>Just Now</muted> -->
          <br />
          <a href="#">type</a><br>content<br />
        </p>
      </div>
    </div>
  </div>
  <!-- /col-lg-3 -->
</div>
@endsection

@push('scripts')
<script src="lib/xchart/d3.v3.min.js"></script>
<script src="lib/xchart/xcharts.min.js"></script>
<script type="application/javascript">
  $(document).ready(function() {
    $("#date-popover").popover({
      html: true,
      trigger: "manual"
    });
    $("#date-popover").hide();
    $("#date-popover").click(function(e) {
      $(this).hide();
    });

    $("#my-calendar").zabuto_calendar({
      action: function() {
        return myDateFunction(this.id, false);
      },
      action_nav: function() {
        return myNavFunction(this.id);
      },
      ajax: {
        url: "show_data.php?action=1",
        modal: true
      },
      legend: [{
          type: "text",
          label: "Special event",
          badge: "00"
        },
        {
          type: "block",
          label: "Regular event",
        }
      ]
    });
  });

  function myNavFunction(id) {
    $("#date-popover").hide();
    var nav = $("#" + id).data("navigation");
    var to = $("#" + id).data("to");
    console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
  }
</script>

<script>
  (function() {
    var data = [{
      "xScale": "ordinal",
      "comp": [],
      "main": [{
        "className": ".main.l2",
        "data": []
      }],
      "type": "bar",
      "yScale": "linear"
    }];
    var order = [0],
      i = 0,
      xFormat = d3.time.format('%A'),
      chart = new xChart('line-dotted', data[0], '#chart', {
        axisPaddingTop: 5,
        dataFormatX: function(x) {
          return Number(x);
          return new Date(x);
        },
        tickFormatX: function(x) {
          const months = [
            "January", "February", "March", "April", "May",
            "June", "July", "August", "September", "October", "November", "December"
          ];
          return months[x - 1];
          return xFormat(x);
        },
        // timing: 1250
      }),
      rotateTimer,
      toggles = d3.selectAll('.multi button'),
      t = 3500;

    function updateChart(i) {
      var d = data[i];
      console.log(d);
      chart.setData(d);
      toggles.classed('toggled', function() {
        return (d3.select(this).attr('data-type') === d.type);
      });
      return d;
    }

    toggles.on('click', function(d, i) {
      clearTimeout(rotateTimer);
      updateChart(i);
    });

    function rotateChart() {
      i += 1;
      i = (i >= order.length) ? 0 : i;
      var d = updateChart(order[i]);
      rotateTimer = setTimeout(rotateChart, t);
    }
    rotateTimer = setTimeout(rotateChart, t);
  }());
  console.log(chart);
</script>
@endpush