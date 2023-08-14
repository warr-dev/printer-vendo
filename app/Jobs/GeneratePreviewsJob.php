<?php

namespace App\Jobs;

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
     * Create a new job instance.
     */
    public function __construct(private $pdfFile)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $pdf=new Pdf($this->pdfFile);
        $destination=dirname($this->pdfFile).'/preview/'.basename($this->pdfFile).'';
        $pdf->saveAllPagesAsImages($destination);
    }
}
