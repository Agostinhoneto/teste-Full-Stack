<?php

namespace App\Jobs;

use App\Models\Colaborador;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Bus\Dispatchable;

class ExportarRelatorio implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $employeeIds;

    public function __construct($employeeIds)
    {
        $this->employeeIds = $employeeIds;
        $this->onQueue('relatorios');
    }

    public function handle()
    {
       
        Log::info('Iniciando exportação de relatório para os IDs: ' . json_encode($this->employeeIds));

        try {
            if (empty($this->employeeIds)) {
                throw new \Exception('Nenhum ID de colaborador fornecido.');
            }

            $employees = Colaborador::whereIn('id', $this->employeeIds)->get();
            if ($employees->isEmpty()) {
                Log::warning('Nenhum colaborador encontrado com os IDs fornecidos: ' . json_encode($this->employeeIds));
                return;
            }

            $csvContent = $this->generateCsvContent($employees);

            $csvFileName = 'employee_report_' . Carbon::now()->format('YmdHis') . '.csv';

            Storage::disk('public')->put($csvFileName, $csvContent);

            Log::info('Relatório exportado com sucesso: ' . $csvFileName);

            // Mail::to('admin@example.com')->send(new ReportMail($csvFileName));
        } catch (\Exception $e) {
            Log::error('Erro ao exportar relatório: ' . $e->getMessage());
            $this->fail($e);
        }
    }

    protected function generateCsvContent($employees)
    {
        $output = fopen('php://temp', 'w');

        fputcsv($output, ['ID', 'Nome', 'Email', 'Data de Cadastro']);
        foreach ($employees as $employee) {
            fputcsv($output, [
                $employee->id,
                $employee->nome,
                $employee->email,
                $employee->created_at->format('d/m/Y H:i:s'), 
            ]);
        }
        rewind($output);
        $csvContent = stream_get_contents($output);
        fclose($output);

        return $csvContent;
    }
}