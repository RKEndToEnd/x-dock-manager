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
            'vehicle id',
            'track number',
            'track type',
            'freight',
            'eta',
            'docking plan',
            'docked at',
            'ramp',
            'worker id',
            'operation start',
            'expecting stop',
            'expecting doc return',
            'operation stop',
            'documents ready',
            'comment',
            'departure',
        ];
    }
    public function registerEvents(): array
    {
        return[
            AfterSheet::class=>function(AfterSheet $event){
            $event->sheet->getStyle('A1:P1')->applyFromArray([
                'font'=>[
                    'bold'=>true
                ]
            ]);
            }
        ];
    }
}
