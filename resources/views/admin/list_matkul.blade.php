@extends('themes.template')
@section('konten')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">

                    <div class="d-flex">
                        <h6>List Matakuliah</h6>
                        <a href="" class="btn btn-primary ms-auto justify-content-end me-5" data-bs-toggle="modal"
                            data-bs-target='#addJurusan'>Tambah</a>
                    </div>

                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center text-secondary opacity-7">Jurusan</th>
                                    <th class="text-center text-secondary opacity-7">Prodi</th>
                                    <th class="text-center text-secondary opacity-7">Matakuliah</th>
                                    <th class="text-center text-secondary opacity-7">SKS</th>
                                    <th class="text-center text-secondary opacity-7">Kuota</th>
                                    <th class="text-center text-secondary opacity-7">Tahun Ajaran</th>
                                    <th class="text-secondary opacity-7 text-center">action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!count($data))
                                <tr>
                                    <td colspan="5" class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">Data masih kosong</span>
                                    </td>
                                </tr>
                                @else
                                @foreach($data as $d)
                                <tr>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $d->nama_jurusan
                                            }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $d->prodi }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $d->matkul }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $d->sks }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $d->kuota }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <?php $awal =  new DateTime($d->tahun_awal); $akhir = new DateTime($d->tahun_akhir);  ?>
                                        <span class="text-secondary text-xs font-weight-bold">{{ $awal->format('Y') }} /
                                            {{ $akhir->format('Y') }} </span>
                                    </td>
                                    <td class="align-middle text-center ">
                                        <a href="#" class="text-secondary font-weight-bold text-xm openModal"
                                            data-original-title="Edit jurusan" data-bs-toggle="modal"
                                            data-bs-target='#editJurusan{{ $d->id_mk }}'>
                                            Edit |
                                        </a>
                                        <a href="{{ url('jurusan') }}"
                                            class="text-secondary font-weight-bold text-xm openModal"
                                            data-original-title="Delete jurusan">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                @endif

                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end me-5 mt-3">
                            {!! $data->links() !!}
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
@section('modal')
<!-- Modal -->
<div class="modal fade" id="addJurusan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Form Add</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" style="color: black;"
                    aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('jurusan_add') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <input type="text" class="form-control" list="prodi" name="prodi_id">
                        <datalist id="prodi">
                            @foreach($prodi as $p)
                            <option value="{{ $p['id_prodi'] }}"> {{ $p['nama_jurusan'] }} || {{ $p['prodi'] }} </option>
                            @endforeach
                        </datalist>
                       
                        @if ($errors->has('prodi_id'))
                        <span class="text-danger">{{ $errors->first('prodi_id') }}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control form-control-lg" placeholder="Matkul" aria-label="Matkul"
                            name="matkul">
                        @if ($errors->has('matkul'))
                        <span class="text-danger">{{ $errors->first('matkul') }}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control form-control-lg" placeholder="SKS" aria-label="SKS"
                            name="sks">
                        @if ($errors->has('sks'))
                        <span class="text-danger">{{ $errors->first('sks') }}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control form-control-lg" placeholder="180" aria-label="Kuota"
                            name="kuota">
                        @if ($errors->has('kuota'))
                        <span class="text-danger">{{ $errors->first('kuota') }}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="">Tahun Awal</label>
                        <input type="date" class="form-control form-control-md" id="datep1" aria-label="Tahun Ajaran"
                            name="tahun_awal">
                        <label for="">Tahun Akhir</label>
                        <input type="date" class="form-control form-control-md" id="datep2" aria-label="Tahun Ajaran"
                            name="tahun_akhir">
                        @if ($errors->has('tahun_ajaran') || $errors->has('tahun_ajaran2'))
                        <span class="text-danger">{{ $errors->first('tahun_ajaran') }}</span>
                        @endif
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
@foreach($data as $d)
<div class="modal fade" id="editJurusan{{ $d->id_mk }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" style="color: black;"
                    aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <form action="{{ url('jurusan_edit', [$d->id_mk]) }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <input type="text" class="form-control" list="prodi">
                        <datalist id="pordi">
                            @foreach($prodi as $p)
                            <option value="{{ $p->id_prodi }}" <?php if ($p->id_prodi == $d->prodi_id) : echo
                                "Selected";
                                endif; ?>>
                                {{ $p->nama_jurusan }} || {{ $p->prodi }}
                            </option>
                            @endforeach
                        </datalist>
                        @if ($errors->has('prodi_id'))
                        <span class="text-danger">{{ $errors->first('prodi_id') }}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control form-control-lg" value="{{ $d->matkul }}"
                            aria-label="Matkul" name="matkul">
                        @if ($errors->has('matkul'))
                        <span class="text-danger">{{ $errors->first('matkul') }}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control form-control-lg" value="{{ $d->sks }}" aria-label="SKS"
                            name="sks">
                        @if ($errors->has('sks'))
                        <span class="text-danger">{{ $errors->first('sks') }}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control form-control-lg" value="{{ $d->kuota }}"
                            aria-label="Kuota" name="kuota">
                        @if ($errors->has('kuota'))
                        <span class="text-danger">{{ $errors->first('kuota') }}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <input type="date" class="form-control form-control-lg" id="datep1" aria-label="Tahun Ajaran"
                            name="tahun_awal" value="{{ $d->tahun_awal }}"> /
                        <input type="date" class="form-control form-control-lg" id="datep2" aria-label="Tahun Ajaran"
                            name="tahun_akhir" value="{{ $d->tahun_akhir }}">
                        @if ( $errors->has('tahun_ajaran') || $errors->has('tahun_ajaran2') )
                        <span class="text-danger">{{ $errors->first('tahun_ajaran') }}</span>
                        @endif
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection