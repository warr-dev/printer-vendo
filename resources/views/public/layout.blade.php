<!DOCTYPE html>
<html>

@include('public.partials.head')

<body style="max-height:100vh">

    <div class="bg"></div>
    <div class="content">
        @include('partials.alert')
        <div class="container">
            <div id="showtime"></div>
            <div>
                <h3>Printer Vendo: </h3><span>Raspberrypi Powered Printer Vending Machine</span>
                <hr>
                <center>
                    <table>
                        <!-- <tr>
                      <td class="left"><h4>IP:</h4></td>
                      <td class="left"><h4>dasdasd</h4></td>
                    </tr> -->
                        <tr>
                            <td class="left">
                                <h4>MAC:</h4>
                            </td>
                            <td class="left">
                                <h4>{{ $client->mac }}</h4>
                            </td>
                        </tr>
                        <tr>
                            <td class="left">
                                <h4>Credits:</h4>
                            </td>
                            <td class="left">
                                <h4 style="color:white" id="mcreds" class="credits">{{ $client->credits }} PHP</h4>
                            </td>
                        </tr>
                    </table>
                </center>
            </div>
            <div class="col-lg-4 col-lg-offset-4">
                <div class="lock-screen">
                    <div class="action">
                        <div>
                            <h4><a data-toggle="modal" href="#uploadDocs"><i class="fa fa-upload" style="font-size:5rem"></i></a></h4>
                            <p>Add File</p>
                        </div>
                        <div>
                            <h4><a data-toggle="modal" class="addcoins" href="#addcoins"><i class="fa fa-dollar" style="font-size:5rem"></i></a></h4>
                            <p>Add Credits</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /col-lg-4 -->
            <div id="af" class="scrollmenu" style="width:100%">
                @include('partials.uploads')
            </div>
            <!-- /lock-screen -->
        </div>
        <!-- /container -->

    </div>
    @include('public.partials.upload-docs-modal')

    @include('public.partials.print-modal-container')

    @include('public.partials.transaction-summary-modal')

    @include('public.partials.add-coins-modal')

    @include('public.partials.printing-modal')


    @include('public.partials.scripts')

</body>

</html>