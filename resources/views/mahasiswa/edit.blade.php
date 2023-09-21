@extends('layout.main')

@section('judul')
    Data Mahasiswa
@endsection

@section('isi')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <button type="button" class="btn btn-sm btn-warning" onclick="window.location='/mhs/index'">
                    &laquo; Kembali
                </button>
            </h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <form enctype="multipart/form-data" method="POST" action="{{ url('/mhs/update') }}">
                @csrf
                @method('PUT')
                <table class="table table-striped">
                    <tr>
                        <td>NIM :</td>
                        <td>
                            <input type="number" name="nim" id="nim" value="{{ $nim }}" readonly
                                style="cursor: not-allowed" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td>Nama Mahasiswa :</td>
                        <td>
                            <input type="text" name="nama" id="nama" value="{{ $nama }}"
                                class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td>No Telp :</td>
                        <td>
                            <input type="number" name="telp" id="telp" value="{{ $telp }}"
                                class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td>Alamat :</td>
                        <td>
                            <textarea name="alamat" id="alamat" cols="50" rows="5" class="form-control">{{ $alamat }}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Foto</td>
                        <td>
                            @if ($foto)
                                <img src="{{ asset('storage/' . $foto) }}" class="img-thumbnail" style="width: 50%;">
                            @else
                                <span class="badge badge-danger">Belum ada foto</span>
                            @endif

                            <input type="file" class="form-control @error('foto') is-invalid @enderror" accept="image/*"
                                name="foto">

                            @error('foto')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <button type="submit" class="btn btn-success">Update</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
@endsection
