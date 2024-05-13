@extends('layout.admin')

@section('content')
    <div class="card">
        @if (session('berhasil'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <p>{{session('berhasil')}}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
        <div class="card-body">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#tambahModal">
                Tambah Data
            </button>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <tr>
                        <th>Id</th>
                        <th>Nama Rekening</th>
                        <th>Saldo Awal</th>
                        <th>Aksi</th>
                    </tr>
                    @foreach ($rekening as $rek)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $rek->namaRekening }}</td>
                            <td>{{ $rek->saldoAwal }}</td>
                            <td>
                                <a type="button" class="btn btn-sm btn-warning ml-1" data-bs-toggle="modal"
                                    data-bs-target="#editModal" data-id="{{ $rek->id }}"
                                    data-nm="{{ $rek->namaRekening }}" data-saldo="{{ $rek->saldoAwal }}">
                                    Edit
                                </a>
                                <a type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal" data-id="{{ $rek->id }}">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

    <!-- Tambah Modal -->
    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Rekening</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('/simpanrekening') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row mb-3 align-items-center">
                            <div class="col-lg-4 col-md-12 text-end">
                                <span>Nama Rekening</span>
                            </div>
                            <div class="col-lg-8 col-md-12">
                                <input type="text" class="form-control" id="nmrek" name="nmrek"
                                    placeholder="Nama Rekening" />
                                <div class="valid-feedback">Woohoo!</div>
                            </div>
                        </div>
                        <div class="row mb-3 align-items-center">
                            <div class="col-lg-4 col-md-12 text-end">
                                <span>Saldo Awal</span>
                            </div>
                            <div class="col-lg-8 col-md-12">
                                <input type="text" class="form-control" id="sa" name="sa"
                                    placeholder="Saldo Awal" />
                                <div class="valid-feedback">Woohoo!</div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Data</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Rekening</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('/editrekening') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row mb-3 align-items-center">
                            <div class="col-lg-4 col-md-12 text-end">
                                <span>Nama Rekening</span>
                            </div>
                            <div class="col-lg-8 col-md-12">
                                <input type="hidden" id="idrek" name="idrek">
                                <input type="text" class="form-control" id="nmrek1" name="nmrek1"
                                    placeholder="Nama Rekening" />
                                <div class="valid-feedback">Woohoo!</div>
                            </div>
                        </div>
                        <div class="row mb-3 align-items-center">
                            <div class="col-lg-4 col-md-12 text-end">
                                <span>Saldo Awal</span>
                            </div>
                            <div class="col-lg-8 col-md-12">
                                <input type="text" class="form-control" id="sa1" name="sa1"
                                    placeholder="Saldo Awal" />
                                <div class="valid-feedback">Woohoo!</div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('/deleterekening') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="id" name="id">
                        <h5>Hapus Rekening ?</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete Data</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('#editModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var nm = button.data('nm');
            var saldo = button.data('saldo');

            var modal = $(this)
            modal.find('.modal-body #idrek').val(id);
            modal.find('.modal-body #nmrek1').val(nm);
            modal.find('.modal-body #sa1').val(saldo);
        });

        $('#deleteModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');

            var modal = $(this)
            modal.find('.modal-body #id').val(id);
        });
    </script>
@endsection
