@extends('layouts.admin.back-end')

@section('title', 'Surat Aktif Kuliah')

@push('styles')
@endpush

@section('header')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <h2 class="page-title">
                        Surat Aktif Kuliah
                    </h2>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="col-12">
                    <div class="card" style="padding: 20px; margin-bottom: 20px;">
                        <div class="table-responsive">
                            {{ $dataTable->table(['class' => 'table card-table table-vcenter text-nowrap'], true) }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs nav-fill" data-bs-toggle="tabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a href="#tabs-home-5" class="nav-link active" data-bs-toggle="tab" aria-selected="true"
                                    role="tab">AKTIF</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="#tabs-profile-5" class="nav-link" data-bs-toggle="tab" aria-selected="false"
                                    role="tab" tabindex="-1">BPJS</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="#tabs-activity-5" class="nav-link" data-bs-toggle="tab" aria-selected="false"
                                    role="tab" tabindex="-1">PNS</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        @include('tabPanel.suratAktif')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
