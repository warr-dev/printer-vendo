<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
            <p class="centered"><a href="profile.html"><img src="img/ui-sam.jpg" class="img-circle" width="80"></a></p>
            <h5 class="centered">Sam Soffes</h5>
            <li class="mt">
                <a class="{{Route::currentRouteNamed('admin.index')?'active':''}}" href="">
                    <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="mt">
                <a class="{{Route::currentRouteNamed('admin.printlogs')?'active':''}}" href="logs.php">
                    <i class="fa fa-bar-chart-o"></i>
                    <span>Print Logs</span>
                </a>
            </li>
            <li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa fa-cogs"></i>
                    <span>Configurations</span>
                </a>
                <ul class="sub">
                    <li class="{{Route::currentRouteNamed('admin.prices')?'active':''}}"><a href="prices.php">Prices</a></li>
                    <!-- <li><a href="calendar.html">Calendar</a></li>
              <li><a href="gallery.html">Gallery</a></li>
              <li><a href="todo_list.html">Todo List</a></li>
              <li><a href="dropzone.html">Dropzone File Upload</a></li>
              <li><a href="inline_editor.html">Inline Editor</a></li>
              <li><a href="file_upload.html">Multiple File Upload</a></li> -->
                </ul>
            </li>
        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
<!-- **********************************************************************************************************************************************************