@extends('layouts.admin.back-end')

@section('title', 'Mahasiswa')

@push('styles')
    <link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
@endpush

@section('header')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <h2 class="page-title">
                        Mahasiswa
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none" data-bs-toggle="modal" data-bs-target="#modal-import">
                    <div class="btn-list">
                        <span class="d-none d-sm-inline">
                            <a href="#" class="btn">
                                Import
                            </a>
                        </span>
                        <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                            data-bs-target="#modal-mahasiswa">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 5l0 14"></path>
                                <path d="M5 12l14 0"></path>
                            </svg>
                            Mahasiswa
                        </a>
                        <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                            data-bs-target="#modal-report" aria-label="Tambah Mahasiswa">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 5l0 14"></path>
                                <path d="M5 12l14 0"></path>
                            </svg>
                        </a>
                    </div>
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
        </div>
    </div>

    <!-- Include Modal Mahasiswa-->
    @include('modalForm.mahasiswaModal')
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    {{ $dataTable->scripts() }}

    <script>
        function showDetailModal(id) {
            // Lakukan AJAX untuk mendapatkan data
            $.ajax({
                url: '/mahasiswa/' + id,
                method: 'GET',
                success: function(data) {
                    $('#namaMahasiswa').val(data.nama_mahasiswa);
                    $('#nimMahasiswa').val(data.nim);
                    $('#prodiMahasiswa').val(data.prodi.nama_prodi);
                    $('#detailModal').modal('show');
                }
            });
        }

        function showEditModal(id) {
            // Lakukan AJAX untuk mendapatkan data
            $.ajax({
                url: '/mahasiswa/' + id + '/edit',
                method: 'GET',
                success: function(data) {
                    $('#editNama').val(data.nama_mahasiswa);
                    $('#editNim').val(data.nim);
                    $('#editProdi').val(data.prodi_id);
                    $('#editForm').attr('action', '/mahasiswa/' + id);
                    $('#editModal').modal('show');
                }
            });
        }

        // Tangani submit form update
        $('#editForm').on('submit', function(event) {
            event.preventDefault(); // Mencegah reload halaman

            let formData = $(this).serialize(); // Ambil data dari form

            $.ajax({
                url: $(this).attr('action'), // URL dari atribut action pada form
                method: 'POST',
                data: formData,
                success: function(response) {
                    $('#editModal').modal('hide'); // Tutup modal
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.message
                    });
                    $('#mahasiswas-table').DataTable().ajax.reload(); // Reload DataTables
                },
                error: function(xhr) {
                    alert('Terjadi kesalahan saat memperbarui data mahasiswa.');
                    console.error(xhr.responseText);
                }
            });
        });

        $('#importForm').on('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);
            let submitButton = $('#btn-import');

            submitButton.prop('disabled', true);

            $.ajax({
                url: "{{ route('mahasiswa.import') }}",
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#modal-import').modal('hide');
                    $('#mahasiswas-table').DataTable().ajax.reload(); // Reload DataTables
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.message + (response.data ? ` (${response.data.imported_rows} data diimport)` : '')
                    });
                },
                error: function(xhr) {
                    let message = xhr.responseJSON.message;
                    if (xhr.responseJSON.errors) {
                        message += '\n' + xhr.responseJSON.errors.join('\n');
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: message
                    });
                },
                complete: function() {
                    submitButton.prop('disabled', false);
                }
            });
        });
    </script>
    <script>
        $(document).on('click', '.btn-delete', function () {
            let mahasiswaId = $(this).data('id');

            Swal.fire({
                title: "Apakah kamu yakin?",
                text: "Data akan dihapus secara permanen!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, hapus!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/mahasiswa/" + mahasiswaId,
                        type: "DELETE",
                        data: { _token: "{{ csrf_token() }}" },
                        success: function (response) {
                            Swal.fire("Berhasil!", response.message, "success");
                            $('#mahasiswas-table').DataTable().ajax.reload(); // Reload DataTables
                        },
                        error: function (xhr) {
                            Swal.fire("Error!", "Gagal menghapus data.", "error");
                        }
                    });
                }
            });
        });
    </script>
    <script>
        $(document).on('click', '.btn-reset-password', function() {
            let mahasiswaId = $(this).data('id');

            Swal.fire({
                title: "Yakin ingin reset password?",
                text: "Password akan direset menjadi NIM mahasiswa!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Reset!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/mahasiswa/reset/${mahasiswaId}`,
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            Swal.fire("Berhasil!", response.message, "success");
                        },
                        error: function(xhr) {
                            Swal.fire("Error!", "Terjadi kesalahan, coba lagi.", "error");
                        }
                    });
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#form-mahasiswa').submit(function(e) {
                e.preventDefault(); // Mencegah reload halaman

                $.ajax({
                    url: "{{ route('mahasiswa.store') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#modal-mahasiswa').modal('hide'); // Tutup modal
                        Swal.fire("Berhasil!", response.message, "success");
                        $('#form-mahasiswa')[0].reset(); // Reset form
                        $('#mahasiswas-table').DataTable().ajax.reload(); // Reload DataTables
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        let errorMessage = "Terjadi kesalahan!";

                        if (errors) {
                            errorMessage = Object.values(errors).map(err => err[0]).join('<br>');
                        }

                        Swal.fire("Error!", errorMessage, "error");
                    }
                });
            });
        });
    </script>
@endpush
