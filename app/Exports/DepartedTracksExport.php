<?php

namespace App\Exports;

use App\Models\DeparturesControlTower;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class DepartedTracksExport implements FromCollection, Responsable, WithMapping, WithHeadings, WithEvents
{
    use Exportable;
    private $fileName = "departed.xlsx";
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return DeparturesControlTower::with('dids','dtrace')->get();

    }
    public function map($row): array
    {
        return [
            $row->vehicle_id,
            $row->track_id,
            $row->track_type,
            $row->freight,
            $row->eta,
            $row->docking_plan,
            $row->area_arrived,
            $row->docked_at,
            $row->dtrace->name,
            $row->dids->worker_id,
            $row->task_start,
            $row->task_end_exp,
            $row->doc_return_exp,
            $row->task_end,
            $row->doc_ready,
            $row->comment,
            $row->departure,
        ];
    }
    public function headings(): array
    {
        return [
            'nr rejestracyjny',
            'nr trasy',
            'typ trasy',
            'mp',
            'godz. przyjazdu / wyjazdu',
            'podstawienie plan',
            'plac',
            'podstawiono',
            'rampa',
            'id pracownika',
            'przeładunek start',
            'oczekiwane zakończenie',
            'oczekiwany zwrot dokumentów',
            'przeładunek koniec',
            'dokumenty gotowe do wydania',
            'komentarz',
            'odjazd',
        ];
    }
    public function registerEvents(): array
    {
        return[
            AfterSheet::class=>function(AfterSheet $event){
            $event->sheet->getStyle('A1:Q1')->applyFromArray([
                'font'=>[
                    'bold'=>true
                ]
            ]);
            }
        ];
    }
}
