@extends('public.layout')

@section('content')
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
                            <h4><a data-toggle="modal" href="#uploadDocs"><i class="fa fa-upload"
                                        style="font-size:5rem"></i></a></h4>
                            <p>Add File</p>
                        </div>
                        <div>
                            <h4><a data-toggle="modal" class="addcoins" href="#addcoins"><i class="fa fa-dollar"
                                        style="font-size:5rem"></i></a></h4>
                            <p>Add Credits</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /col-lg-4 -->
            <div id="af" class="scrollmenu" style="width:100%">
                @include('public.partials.uploads')
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

@endsection

@push('scripts')
    <script>
        Dropzone.options.myAwesomeDropzone = {
            paramName: "file", // The name that will be used to transfer the file
            maxFilesize: 100, // MB
            sending: function(file, xhr, formData) {
                // Add CSRF token to the formData
                formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute(
                    'content'));
            },
            success: function(file, res) {
                document.getElementById('af').innerHTML = res;
                this.removeFile(file);
                toastr.success('Documents Uploaded Successfully')
                $('#uploadDocs').modal('hide')
            }
        }

        function initFile(filename) {
            $('#printme').modal('show')
            $('#printme').html(loader)
            $.ajax({
                type: "get",
                url: "{{ route('modal.print') }}",
                data: {
                    file: filename
                },
                success: function(response) {
                    $('#printme').html(response)
                    getPagesSummary(filename)
                },
                error: (err) => {
                    toastr.error('error occur', 'try again')
                    $('#printme').modal('hide')
                }
            });
        }

        function getPagesSummary(filename) {
            $.ajax({
                type: "get",
                url: "{{ route('get.summary') }}",
                data: {
                    file: filename
                },
                success: function(res) {
                    // spages = countt(1, res.pages)
                    $('#bw_page').html(
                        res.bw_count > 0 ? `${res.bw_count} pages (${res.bw_pages.join(', ')} )` : 'None'
                    )
                    $('#colored_page').html(
                        res.colored_count > 0 ? `${res.colored_count} pages (${res.colored_pages.join(', ')} )` : 'None'
                    )
                    $('#overly_colored_page').html(
                        res.overly_colored_count > 0 ? `${res.overly_colored_count} pages (${res.overly_colored_pages.join(', ')} )` : 'None'
                    )
                    // compute();
                    // $('#cpages').html(`(${res.colored}) ${res.colored_pages.join(', ')}`)
                    // $('#bnwpages').html(`(${res.bw_counter}) ${res.bwpages.join(', ')}`)
                },
                error: (err) => {
                    alert(err.responseJSON.message);
                }
            });
        }

        function showSummary() {
            $('#summary').modal('show')

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
@endpush
