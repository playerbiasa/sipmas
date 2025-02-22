<?php

namespace App\DataTables;

use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MahasiswasDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($row) {
                return '
                <button class="btn btn-sm btn-info" title="Lihat" onclick="showDetailModal(' . $row->id . ')">
                    <i class="fas fa-eye"></i>
                </button>
                <button class="btn btn-sm btn-primary" title="Edit" onclick="showEditModal(' . $row->id . ')">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="btn btn-sm btn-danger btn-delete" title="Hapus" data-id="' . $row->id . '">
                    <i class="fas fa-trash"></i>
                </button>
            ';
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Mahasiswa $model): QueryBuilder
    {
        // return $model->newQuery();
        return Mahasiswa::with('prodi');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('mahasiswas-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->parameters([
                'ordering' => false, // Nonaktifkan sorting untuk seluruh kolom
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')->title('ID'),
            Column::make('nim')->title('NIM'),
            Column::make('nama_mahasiswa')->title('Nama Mahasiswa'),
            Column::make('prodi.nama_prodi')->title('Program Studi'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->orderable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Mahasiswas_' . date('YmdHis');
    }
}
