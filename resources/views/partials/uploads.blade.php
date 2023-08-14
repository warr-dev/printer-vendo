@foreach (Storage::disk('thumbs')->files(request()->client->getFolder()) as $file)
<div class="scrollitem">
    <div class="row">
        <div class="col-sm-12 text-center">
            <img src="{{ asset('thumbs/' . $file) }}" style="max-width:300px;background-color:white">
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 text-center">
            <table class="table table-borderless">
                <tr>
                    <td class="text-right">
                        <form class="print-form" id="print_form_<?= $file ?>" action="index.php" method="post">
                            <input type="hidden" name="filename" value="<?= $file ?>">
                            <input type="hidden" name="q" value="print">
                            <button data-id="<?= $file ?>" type="button" onclick="initFile('{{ dirname($file).'/preview/'.pathinfo($file)['filename'] }}')" class="btn btn-primary">Print</button>
                        </form>
                    </td>
                    <td class="text-left">
                        <form action="/controller/managefile.php" method="post">
                            <input type="hidden" name="filename" value="<?= $file ?>">
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