@extends('layouts.admin.back-end')

@section('title', 'Undangan Penguji')


@section('header')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <h2 class="page-title">
                        Permohonan Undangan Penguji
                    </h2>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-md-12">
                    <form class="card">
                        <div class="card-header"></div>
                        <div class="card-body">
                            <div class="mb-3 row">
                                <label class="col-3 col-form-label">Jenis Undangan</label>
                                <div class="col">
                                    <select class="form-select">
                                        <option value="1">Seminar Proposal</option>
                                        <option value="2">Sidang Skripsi</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-3 col-form-label required">NIM/Nama</label>
                                <div class="col">
                                    <input type="text" class="form-control" placeholder="Ketik NIM atau Nama..."
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
