<?php

namespace App\Exports;

use App\Models\Prodi;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithTitle;

class MahasiswaTemplateExport implements WithMultipleSheets
{
    use Exportable;

    public function sheets(): array
    {
        return [
            new TemplateSheet(),
            new ProdiSheet(),
        ];
    }
}
class TemplateSheet implements FromCollection, WithHeadings, WithTitle
{
    public function collection()
    {
        return collect([]);
    }

    public function headings(): array
    {
        return [
            'NIM',
            'Nama Mahasiswa',
            'Email',
            'Prodi ID',
        ];
    }

    public function title(): string
    {
        return "Template Mahasiswa";
    }
}

class ProdiSheet implements FromCollection, WithHeadings, WithTitle
{
    public function collection()
    {
        return Prodi::select('id', 'nama_prodi')->get();
    }

    public function headings(): array
    {
        return [
            'ID Prodi',
            'Nama Prodi',
        ];
    }

    public function title(): string
    {
        return 'Daftar Prodi';
    }
}
