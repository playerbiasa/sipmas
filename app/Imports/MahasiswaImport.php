<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MahasiswaImport implements WithMultipleSheets
{
    private $rowCount = 0;

    public function sheets(): array
    {
        return [
            'Template Mahasiswa' => new MahasiswaSheetImport($this),
        ];
    }

    public function incrementRowCount(): void
    {
        $this->rowCount++;
    }

    public function getRowCount(): int
    {
        return $this->rowCount;
    }
}
