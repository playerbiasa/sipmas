@extends('layouts.admin.back-end')

@section('title', 'Mahasiswa')

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
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs nav-fill" data-bs-toggle="tabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a href="#tabs-home-5" class="nav-link active" data-bs-toggle="tab" aria-selected="true" role="tab">AKTIF</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="#tabs-profile-5" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">BPJS</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="#tabs-activity-5" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">PNS</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        @include('tabPanel.suratAktif')
                    </div>
                </div>
            </div>
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table table-striped">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Title</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th class="w-1"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Maryjo Lebarree</td>
                                <td class="text-secondary">
                                    Civil Engineer, Product Management
                                </td>
                                <td class="text-secondary"><a href="#" class="text-reset">mlebarree5@unc.edu</a></td>
                                <td class="text-secondary">
                                    User
                                </td>
                                <td>
                                    <a href="#">Edit</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Egan Poetz</td>
                                <td class="text-secondary">
                                    Research Nurse, Engineering
                                </td>
                                <td class="text-secondary"><a href="#" class="text-reset">epoetz6@free.fr</a></td>
                                <td class="text-secondary">
                                    User
                                </td>
                                <td>
                                    <a href="#">Edit</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Kellie Skingley</td>
                                <td class="text-secondary">
                                    Teacher, Services
                                </td>
                                <td class="text-secondary"><a href="#" class="text-reset">kskingley7@columbia.edu</a></td>
                                <td class="text-secondary">
                                    User
                                </td>
                                <td>
                                    <a href="#">Edit</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Christabel Charlwood</td>
                                <td class="text-secondary">
                                    Tax Accountant, Engineering
                                </td>
                                <td class="text-secondary"><a href="#" class="text-reset">ccharlwood8@nifty.com</a></td>
                                <td class="text-secondary">
                                    Owner
                                </td>
                                <td>
                                    <a href="#">Edit</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Haskel Shelper</td>
                                <td class="text-secondary">
                                    Staff Scientist, Legal
                                </td>
                                <td class="text-secondary"><a href="#" class="text-reset">hshelper9@woothemes.com</a></td>
                                <td class="text-secondary">
                                    User
                                </td>
                                <td>
                                    <a href="#">Edit</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush
