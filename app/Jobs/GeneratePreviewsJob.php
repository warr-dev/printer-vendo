<?php

namespace App\Jobs;

use App\Models\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Spatie\PdfToImage\Pdf;

class GeneratePreviewsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    /**
     * __construct
     *
     * @param  Pdf $pdf
     * @param  string $destination path inside files disk
     * @return void
     */
    public function __construct(private Pdf $pdf, private $destination)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Storage::disk('files')->makeDirectory($this->destination);
        $destination = storage_path('app/files/' . $this->destination);
        Storage::disk('files')->setVisibility($this->destination,'public');
        // echo $destination;
        $pages = $this->pdf->saveAllPagesAsImages($destination);
        // print_r($pages);
    }
}
