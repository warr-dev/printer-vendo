
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
