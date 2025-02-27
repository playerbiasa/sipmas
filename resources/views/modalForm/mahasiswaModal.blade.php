<!-- Modal Tambah Mahasiswa -->
<div class="modal modal-blur fade" id="modal-mahasiswa" data-bs-backdrop="static" tabindex="-1" style="display: none;"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Mahasiswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-mahasiswa">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" name="namaMahasiswa" autocomplete="off" required>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Nomor Induk Mahasiswa (NIM)</label>
                                <div class="input-group input-group-flat">
                                    <input type="number" class="form-control" autocomplete="off" name="nimMahasiswa" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Program Studi</label>
                                <select class="form-select" name="prodi_id" required>
                                    <option value="">Pilih Program Studi</option>
                                    @foreach($prodis as $prodi)
                                        <option value="{{ $prodi->id }}">{{ $prodi->nama_prodi }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" autocomplete="off" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary ms-auto">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                             viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                             stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 5l0 14"></path>
                            <path d="M5 12l14 0"></path>
                        </svg>
                        Create new report
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Import Mahasiswa -->
<div class="modal modal-blur fade" id="modal-import" data-bs-backdrop="static" tabindex="-1" style="display: none;"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Import Mahasiswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="importForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="file" name="file" id="file" class="form-control" required>
                    <div class="mt-3">
                        <p>Silahkan download template import Mahsiswa <a href="{{route('mahasiswa.template')}}" target="_blank">di sini</a></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 5l0 14"></path>
                            <path d="M5 12l14 0"></path>
                        </svg>
                        Import
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Show Mahasiswa -->
<div class="modal modal-blur fade" id="detailModal" data-bs-backdrop="static" tabindex="-1" style="display: none;"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Mahasiswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="namaMahasiswa" readonly>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Nomor Induk Mahasiswa (NIM)</label>
                            <div class="input-group input-group-flat">
                                <input type="text" class="form-control" id="nimMahasiswa" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Program Studi</label>
                            <div class="input-group input-group-flat">
                                <input type="text" class="form-control" id="prodiMahasiswa" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                    Cancel
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Mahasiswa -->
<div class="modal modal-blur fade" id="editModal" data-bs-backdrop="static" tabindex="-1" style="display: none;"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Mahasiswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="editNama" name="nama">
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Nomor Induk Mahasiswa (NIM)</label>
                                <div class="input-group input-group-flat">
                                    <input type="text" class="form-control" id="editNim" name="nim">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Program Studi</label>
                                <select class="form-control form-select" id="editProdi" name="prodi">
                                    @foreach ($prodis as $prodi)
                                        <option value="{{ $prodi->id }}">{{ $prodi->nama_prodi }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 5l0 14"></path>
                            <path d="M5 12l14 0"></path>
                        </svg>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
