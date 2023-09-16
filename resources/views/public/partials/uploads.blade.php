@foreach (\App\Models\Upload::all() as $file)
    <div class="scrollitem">
        <div class="row">
            <div class="col-sm-12 text-center">
                <img src="{{ asset('thumbs/' . $file->getThumb()) }}" style="max-width:300px;background-color:white">
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 text-center">
                <table class="table table-borderless">
                    <tr>
                        <td class="text-right">
                            <form class="print-form" id="print_form" action="index.php" method="post">
                                <input type="hidden" name="filename">
                                <input type="hidden" name="q" value="print">
                                <button type="button" onclick="initFile('{{ $file->id }}')"
                                    class="btn btn-primary">Print</button>
                            </form>
                        </td>
                        <td class="text-left">
                            <form action="{{ route('doc.delete', $file->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="upload_id" value="{{ $file->id }}">
                                <button type="submit" name="action" value="delete" class="btn btn-danger">Del</button>
                            </form>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <br>
    </div>
@endforeach
