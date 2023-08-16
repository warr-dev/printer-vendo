{{-- @dd(App\Models\Client::getPreviewFolder(request()->client,'report 06-01-23.pdf')) --}}
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PrintVendo</title>

    <!-- Favicons -->
    <link href="/img/favicon.png" rel="icon">
    <link href="/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Bootstrap core CSS -->
    <link href="/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!--external css-->
    <link href="/lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="/lib/dropzone/css/dropzone.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/style-responsive.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/toastr.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Custom styles for this template -->
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
        }

        #showtime {
            font-size: 3rem;
            margin: 0;
        }

        .bg {
            /* The image used */
            background-image: url("/img/bg.jpg");
            /* zoom: 1;
 filter: alpha(opacity=50);
 opacity: 0.5; */
            filter: brightness(.4);

            /* Full height */
            height: 100%;
            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .content {
            position: absolute;
            top: 0px;
            color: white;
            height: 100vh;
            width: 100vw;
            text-align: center;
        }

        .left {
            text-align: left
        }

        .right {
            text-align: right;
            min-width: 5rem
        }

        div.scrollmenu {
            overflow: auto;
            white-space: nowrap;
        }

        div.scrollitem {
            display: inline-block;
            color: white;
            text-align: center;
            padding: 14px;
            text-decoration: none;
        }

        .action {
            display: flex;
            justify-content: center;
        }

        .action>div {
            padding: 0 1rem;
        }

        .pic {
            width: 50%;
        }

        h2 {
            color: #4db1bc;
            font-weight: bolder;
            margin: 0;
            grid-column: 1;
            grid-row: 1;
            z-index: 1;
            text-transform: uppercase;
            animation: glow 1s ease-in-out infinite alternate;
            text-align: center;
        }

        td[colspan="2"] {
            text-align: center
        }

        @keyframes glow {
            from {
                text-shadow: 0 0 20px #2d9da9;
            }

            to {
                text-shadow: 0 0 30px #34b3c1, 0 0 10px #4dbbc7;
            }
        }

        .cont {
            padding: 1rem;
        }

        .credits {
            color: black;
        }

        .slider-wrapper {
            margin: 1rem;
            position: relative;
            overflow: hidden;
        }

        .slides-container {
            width: 80%;
            display: flex;
            overflow: hidden;
            scroll-behavior: smooth;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .slide-arrow {
            position: absolute;
            display: flex;
            top: 0;
            bottom: 0;
            margin: auto;
            height: 4rem;
            background-color: white;
            border: none;
            width: 2rem;
            font-size: 3rem;
            padding: 0;
            cursor: pointer;
            opacity: 0.5;
            transition: opacity 100ms;
        }

        .slide-arrow:hover,
        .slide-arrow:focus {
            opacity: 1;
        }

        #slide-arrow-prev {
            left: 0;
            padding-left: 0.25rem;
            border-radius: 0 2rem 2rem 0;
        }

        #slide-arrow-next {
            right: 0;
            padding-left: 0.75rem;
            border-radius: 2rem 0 0 2rem;
        }

        .slide {
            width: 100%;
            height: 100%;
            flex: 1 0 100%;
        }

        .pages-container {
            padding: 1rem
        }
    </style>
</head>

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

    <!-- Modal -->
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="uploadDocs" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Upload Files</h4>
                </div>
                <div class="modal-body">
                    <!--main content start-->
                    <div class="row mt" id="asd">
                        <!-- <div class="white-panel mt">
                        <div class="panel-body">
                          <form action="/controller/uploadfile.php" class="dropzone" id="my-awesome-dropzone"></form>
                        </div>
                      </div> -->
                        <form action="{{ route('doc.store') }}" class="dropzone" id="my-awesome-dropzone"></form>
                    </div>
                </div>
                <div class="modal-footer centered">
                    <!-- <button data-dismiss="modal" class="btn btn-theme04" type="button">Cancel</button> -->
                    <button data-dismiss="modal" class="btn btn-theme03" type="button">Done</button>
                </div>
            </div>
        </div>
    </div>
    <!-- modal -->
    <!-- Modal -->
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="printme" class="modal fade">
    </div>
    <!-- modal -->

    <!-- Modal -->
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="summary" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Transaction Summary</h4>
                </div>
                <div class="modal-body">
                    <center>
                        <div class="alert alert-info"><b>Note: </b> only PDF files has auto pages detect</div>
                        <table>
                            <thead>
                                <tr>
                                    <th></th>
                                    <th style="width:30%">Colored pages</>
                                    <th style="width:30%">BW pages</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>price</td>
                                    <td id="cprice"></td>
                                    <td id="bwprice"></td>
                                </tr>
                                <tr>
                                    <td>pages</td>
                                    <td id="cpages"></td>
                                    <td id="bnwpages"></td>
                                </tr>
                                <tr>
                                    <td>paper size</td>
                                    <td colspan="2" style="text-align:center" id="psize"></td>
                                </tr>
                                <tr>
                                    <td>copies</td>
                                    <td colspan="2" style="text-align:center" id="copies"></td>
                                </tr>
                                <tr style="border-top:black 1px solid">
                                    <td>Total</td>
                                    <td id="ctotal"></td>
                                    <td id="bwtotal"></td>
                                </tr>
                            </tbody>
                        </table>
                    </center>
                </div>
                <div class="modal-footer centered">
                    <button data-dismiss="modal" class="btn btn-theme03" type="button">OK</button>
                </div>
            </div>
        </div>
    </div>
    <!-- modal -->

    <!-- Modal -->
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="addcoins" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Insert Coins</h4>
                </div>
                <div class="modal-body">
                    <center>
                        <img src="/img/coin.png" class="pic">
                        <h2 class="blinking">Insert coin to add credits!!</h2>
                        <h3 id="timer">timer</h3>
                        <p>Credits: <span class="credits"></span></p>
                    </center>
                </div>
                <div class="modal-footer centered">
                    <button data-dismiss="modal" class="btn btn-theme04" type="button">Cancel</button>
                    <button class="btn btn-theme02 addcoins" type="button">Add coins</button>
                    <button data-dismiss="modal" class="btn btn-theme03" type="button">Done</button>
                </div>
            </div>
        </div>
    </div>
    <!-- modal -->

    <!-- Modal -->
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="printing" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Printing</h4>
                </div>
                <div class="modal-body">
                    <div id="status">
                    </div>
                </div>
                <div class="modal-footer centered">
                    <button id="cancelprint" class="btn btn-theme04" type="button">Cancel Printing</button>
                    <button data-dismiss="modal" class="btn btn-theme03" type="button">Done</button>
                </div>
            </div>
        </div>
    </div>
    <!-- modal -->


    <!-- js placed at the end of the document so the pages load faster -->
    <script src="/lib/jquery/jquery.min.js"></script>
    <script src="/lib/bootstrap/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="/lib/jquery.dcjqaccordion.2.7.js"></script>
    <script src="/lib/jquery.scrollTo.min.js"></script>
    <script src="/lib/jquery.nicescroll.js" type="text/javascript"></script>
    <!--common script for all pages-->
    <script src="/lib/common-scripts.js"></script>
    <!--script for this page-->
    <script src="/lib/dropzone/dropzone.js"></script>
    <script src="/lib/toastr.min.js"></script>
    <script>
        const initFile = filename => {
            $('#printme').modal('show')
            $('#printme').html('Loading...')
            $.ajax({
                type: "get",
                url: "{{ route('modal.print') }}",
                data: {
                    file: filename
                },
                success: function(response) {
                    $('#printme').html(response)
                }
            });
        }
        Dropzone.options.myAwesomeDropzone = {
            paramName: "file", // The name that will be used to transfer the file
            maxFilesize: 100, // MB
            sending: function(file, xhr, formData) {
                // Add CSRF token to the formData
                formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
            },
            success: function(file, res) {
                document.getElementById('af').innerHTML = res;
                this.removeFile(file);
                toastr.success('Documents Uploaded Successfully')
                $('#uploadDocs').modal('hide')
            }
        }

        // $('.addcoins').click((e) => {
        //     $.ajax({
        //         url: "cont.php?trigger=$mac",
        //         error: (err) => {
        //             if (err.status == 500) $('#timer').html('server error')
        //             if (err.status == 400) $('#timer').html(err.responseText)
        //         },
        //         success: (res) => {
        //             starttimer();
        //         }
        //     });
        // })

        // function starttimer() {
        //     let timer2 = 15;
        //     const timer = setInterval(() => {
        //         $.ajax({
        //             url: "cont.php?coins=$mac",
        //             error: (err) => {
        //                 if (err.status == 500) $('#credits').html('error')
        //             },
        //             success: (res) => {
        //                 res = JSON.parse(res)
        //                 // $('.credits').map((ind,cred)=>{
        //                 //   console.log(cred);
        //                 //   cred.innerHTML=res.credits+' PHP'
        //                 // })
        //                 $('.credits').html(res.credits + ' PHP')
        //                 // $('#mcreds').html(res.credits+' PHP')
        //             }
        //         });
        //         $('#timer').html(timer2)
        //         if (timer2 == 0) {
        //             $('#timer').html('')
        //             clearInterval(timer);
        //         }
        //         timer2--;
        //     }, 1000);
        // }

        // function getCoins() {
        //     $.ajax({
        //         url: "cont.php?coins=$mac",
        //         error: (err) => {
        //             if (err.status == 500) $('#credits').html('error')
        //         },
        //         success: (res) => {
        //             res = JSON.parse(res)
        //             // $('.credits').map((ind,cred)=>{
        //             //   console.log(cred);
        //             //   cred.innerHTML=res.credits+' PHP'
        //             // })
        //             $('.credits').html(res.credits + ' PHP')
        //             // $('#mcreds').html(res.credits+' PHP')
        //         }
        //     });
        // }

        // function setdoc(node, f) {
        //     let img = node.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.children[
        //         0].children[0].children[0];
        //     document.querySelector('#printimg').src = img.src;
        //     file = f;
        //     let extension = file.split('.').pop()
        //     if (extension == 'pdf') {
        //         $('#sumbut').show()
        //         $.ajax({
        //             url: "controller/checkcolors.php",
        //             type: 'post',
        //             data: {
        //                 checkcolors: file
        //             },
        //             error: (err) => {
        //                 alert('error ')
        //             },
        //             success: (res) => {
        //                 res = JSON.parse(res);
        //                 console.log(res);
        //                 bwpages = res.bwpages
        //                 colpages = res.colored_pages
        //                 spages = countt(1, res.pages)
        //                 $('#bwpages').html(
        //                     `<span>Detected BW pages: ${res.bw_counter} pages (${bwpages.join(', ')} )</span>`
        //                 )
        //                 $('#colpages').html(
        //                     `<span>Detected Colored pages: ${res.colored} pages (${colpages.join(', ')} )</span>`
        //                 )
        //                 compute();
        //                 // $('#cpages').html(`(${res.colored}) ${colpages.join(', ')}`)
        //                 // $('#bnwpages').html(`(${res.bw_counter}) ${bwpages.join(', ')}`)
        //             },
        //         });
        //     } else {
        //         $('#sumbut').hide()
        //         $('#bwpages').html('')
        //         $('#colpages').html('')
        //     }
        // }
        // let file;
        // let bwpages = [];
        // let colpages = [];
        // let spages = [];
        // $('.compute').change((event) => {
        //     compute()
        // });
        // let prices = {};
        // $.ajax({
        //     url: "cont.php?prices",
        //     error: (err) => {
        //         if (err.status == 500) alert('error fetching prices')
        //     },
        //     success: (res) => {
        //         res = JSON.parse(res);
        //         // prices=res;
        //         res.map((price) => {
        //             prices = Object.assign({}, prices, {
        //                 [price.name]: price.price
        //             })
        //         });
        //         compute();
        //     },
        // });

        // function compute() {
        //     let toprint = [];
        //     let type = $(':input[name="type"]:checked').val();
        //     // let size=$(':input[name="size"]:checked').val();
        //     let size = $('#papersize').val();
        //     let pages = $(':input[name="pages"]').val();
        //     pages = pages.split(',');
        //     let c = 0
        //     if (pages == "") {
        //         toprint = spages;
        //     } else
        //         pages.map((page) => {
        //             if (page.indexOf('-') > -1) {
        //                 nums = page.split('-');
        //                 c += nums[1] - nums[0] + 1
        //                 let ar = countt(Number(nums[0]), Number(nums[1]));
        //                 // console.log('ar',ar)
        //                 toprint = [...toprint, ...ar];
        //             } else {
        //                 c += 1
        //                 toprint.push(Number(page))
        //             }
        //         })

        //     let copies = $(':input[name="copies"]').val();
        //     let bwprice = Object.entries(prices).filter((price) => price[0] == 'grayscale')[0][1]
        //     let colprice = Object.entries(prices).filter((price) => price[0] == 'colored')[0][1]
        //     let selprice = Object.entries(prices).filter((price) => price[0] == type)[0][1]
        //     let paper = Object.entries(prices).filter((pr) => pr[0] == size)[0][1]
        //     let extension = file && file.split('.').pop()
        //     let bwprintcount = toprint.filter((pr) => bwpages.includes(pr))
        //     let colprintcount = toprint.filter((pr) => colpages.includes(pr))
        //     $('#cpages').html(`(${colprintcount.length}) ${colprintcount.join(', ')}`)
        //     $('#bnwpages').html(`(${bwprintcount.length}) ${bwprintcount.join(', ')}`)
        //     let price = 0;
        //     $('#cprice').html(colprice)
        //     $('#bwprice').html(bwprice)
        //     $('#psize').html(`(${size}) ${paper} PHP`)
        //     $('#copies').html(`(${copies})`)
        //     if (extension == 'pdf') {
        //         // console.log('print',toprint)
        //         if (type == "colored") {
        //             $('#sumbut').show();
        //             let bp = bwprice * paper * copies * bwprintcount.length;
        //             let cp = colprice * paper * copies * colprintcount.length;
        //             price += bp;
        //             price += cp;
        //             $('#ctotal').html(cp + ' PHP')
        //             $('#bwtotal').html(bp + ' PHP')

        //         } else {
        //             $('#sumbut').hide();
        //             price = bwprice * paper * copies * toprint.length;
        //         }
        //     } else {
        //         price += selprice * paper * copies;
        //     }
        //     $('#price').html(price + ' PHP')
        //     // console.log(bwprintcount,colprintcount)
        // }
        // // compute();
        // function countt(from, to) {
        //     array = [];
        //     while (from <= to) {
        //         array.push(from)
        //         from++;
        //     }
        //     return array;
        // }

        // function printit() {
        //     $('#printing').modal('show');
        //     $.ajax({
        //         url: "controller/printfile.php",
        //         type: "post",
        //         data: {
        //             printfile: file,
        //             type: $(':input[name="type"]').val(),
        //             size: $(':input[name="size"]').val(),
        //             pages: $(':input[name="pages"]').val(),
        //             copies: $(':input[name="copies"]').val(),
        //         },
        //         error: (err) => {
        //             $('#status').html($('#status').html() + '<br>' + err)
        //         },
        //         success: (res) => {
        //             // res=JSON.parse(res);
        //             $('#status').html($('#status').html() + '<br>' + res)
        //             getCoins();
        //             let str = 'request id is';
        //             let pos = res.indexOf(str);
        //             if (pos !== false) {
        //                 // let lent=(res.indexOf('(')-1)-pos;
        //                 pos = pos + str.length
        //                 let reqid = res.substring(res.indexOf(str) + str.length, res.indexOf('('))
        //                 $('#cancelprint').click((e) => {
        //                     cprint(reqid)
        //                 })
        //             }
        //         },
        //     });
        // }

        // function cprint(reqid) {
        //     $.ajax({
        //         url: "controller/cancelprint.php",
        //         type: "post",
        //         data: {
        //             reqid: reqid,
        //         },
        //         error: (err) => {
        //             $('#status').html($('#status').html() + '<br>' + err)
        //         },
        //         success: (res) => {
        //             // res=JSON.parse(res);
        //             $('#status').html($('#status').html() + '<br>' + res)

        //         },
        //     });
        // }
    </script>
</body>

</html>