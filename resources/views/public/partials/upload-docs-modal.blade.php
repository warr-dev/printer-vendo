
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
                        <form action="{{ route('upload.doc') }}" class="dropzone" id="my-awesome-dropzone"></form>
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