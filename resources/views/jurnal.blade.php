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
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <a href="{{ url('/addjurnal') }}" class="btn btn-sm btn-success my-4"><i
                            class="fas fa-plus me-2"></i>Jurnal</a>
                    <tr>
                        <th>Id</th>
                        <th>Tanggal</th>
                        <th>Rekening</th>
                        <th>Keterangan</th>
                        <th>Debet</th>
                        <th>Kredit</th>
                        <th>Aksi</th>
                    </tr>
                    @foreach ($jurnal as $jur)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $jur->tgl_jurnal }}</td>
                            <td>{{ $jur->namaRekening }}</td>
                            <td>{{ $jur->keterangan }}</td>
                            <td>{{ $jur->debet }}</td>
                            <td>{{ $jur->kredit }}</td>
                            <td>
                                <a type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal" data-id="{{ $jur->id }}">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
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
                <form action="{{ url('/deletejurnal') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="id" name="id">
                        <h5>Hapus Jurnal ?</h5>
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
        $('#deleteModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');

            var modal = $(this)
            modal.find('.modal-body #id').val(id);
        });
    </script>
@endsection
