@extends('layout.admin')

@section('content')
    <div class="card">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/jurnal">Jurnal</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Jurnal</li>
            </ol>
        </nav>
        @if (session('berhasil'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <p>{{session('berhasil')}}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
        <div class="card-body">
            <form action="{{url('/createjurnal')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Tanggal</label>
                            <div class="input-group">
                                <input type="date" id="tgl_jurnal" name="tgl_jurnal" class="form-control"
                                    placeholder="mm/dd/yyyy" />
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea name="keterangan" id="keterangan" cols="50" rows="2" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="tabel_jurnal">
                            <tr>
                                <th>Id/Nama Rekening</th>
                                <th>Debet</th>
                                <th>Kredit</th>
                                <th>Aksi</th>
                            </tr>
                            <tr>
                                <td>
                                    <select class="form-control" name="addmore[0][idrek]" id="idrek">
                                        <option>Pilih Rekening</option>
                                        @foreach ($rekening as $rek)
                                            <option value="{{ $rek->id }}">{{ $rek->namaRekening }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="number" class="form-control" id="debet" name="addmore[0][debet]">
                                </td>
                                <td>
                                    <input type="number" class="form-control" id="kredit" name="addmore[0][kredit]">
                                </td>
                                <td>
                                    <button type="button" name="add" id="add"
                                        class="btn btn-sm btn-primary btn-rounded add">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <button type="submit" class="btn btn-warning"><i class="fas fa-save me-2"></i>Save</button>
                </div>
        </div>
        </form>
    </div>
@endsection

@section('js')
    <script>
        var i = 0;
        $('#add').click(function() {
            i++;
            var newBaris = '<tr>' +
                '<td>' +
                '<select class="form-control" name="addmore[' + i + '][idrek]" id="idrek_' + i + '">' +
                '<option>Pilih Rekening</option>' +
                '@foreach ($rekening as $rek)' +
                '<option value="{{ $rek->id }}">{{ $rek->namaRekening }}</option>' +
                '@endforeach' +
                '</select>' +
                '</td>' +
                '<td>' +
                '<input type="number" class="form-control" id="debet" name="addmore[' + i + '][debet]">' +
                '</td>' +
                '<td>' +
                '<input type="number" class="form-control" id="kredit" name="addmore[' + i + '][kredit]">' +
                '</td>' +
                '<td>' +
                '<button type="button" class="btn btn-sm btn-danger btn-rounded remove"><i class="fas fa-trash"></i></button>' +
                '</td>' +
                '</tr>';
            $('#tabel_jurnal').append(newBaris);
            $('#idrek_' + i).select();
        });

        $(document).on('click', '.remove', function() {
            $(this).parents('tr').remove();
        });
    </script>
@endsection
