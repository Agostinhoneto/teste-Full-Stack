<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ExportarRelatorio implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $relatorioId;

    /**
     * Create a new job instance.
     */
    public function __construct($relatorioId)
    {
        $this->relatorioId = $relatorioId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        sleep(10);
        $caminhoArquivo = "relatorios/relatorio_{$this->relatorioId}.csv";
        $conteudo = "conteúdo do relatório ID: {$this->relatorioId}";
        Storage::put($caminhoArquivo, $conteudo);

        Log::info("Relatório exportado: {$caminhoArquivo}");
    }
}