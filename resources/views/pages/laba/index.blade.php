@extends('layouts.app')

@section('title', $title)

@section('addon-css')
<link rel="stylesheet" href="{{ url('assets/modules/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ url('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ url('assets/modules/izitoast/css/iziToast.min.css') }}">
@endsection

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ $title }}</h1>
        </div>

        <div class="section-body">
            <h2 class="section-title">
                {{ $title }}
            </h2>
            <p class="section-lead">
                Berisi perhitungan akumulasi laba.
            </p>

            <div class="card">
                <div class="card-header">
                    <a href="{{ route('laba.create') }}" class="btn btn-icon icon-left btn-primary"><i class="fas fa-plus"></i> Tambah</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="myTable">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        No
                                    </th>
                                    <th>Tanggal</th>
                                    <th>Pembuat</th>
                                    <th>Rincian</th>
                                    <th>Jumlah</th>
                                    <th>Keterangan</th>
                                    <th>Bukti</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($items as $index => $item)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>{{ date('d-m-Y', strtotime($item->tgl)) }}</td>
                                    <td>{{ $item->user }}</td>
                                    <td>{{ $item->beban }}</td>
                                    <td>Rp. {{ number_format($item->jumlah, 0,',','.') }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td class="text-center">
                                        <img src="{{ Storage::disk('public')->exists($item->photo) ? Storage::url($item->photo) : url('assets/img/image_not_available.png') }}" class="img-fluid rounded mt-1 mb-1" height="10px" width="80px" data-toggle="modal" data-target="#myModal" onclick="document.getElementById('img01').src = this.src;">
                                    </td>

                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <form>
                                                <a href="{{ route('laba.edit', $item->id) }}" class="btn btn-success btn-icon icon-left mr-2">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                            </form>
                                            <form action="{{ route('laba.destroy', $item->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger btn-icon icon-left btn-delete">
                                                    <i class="fas fa-trash-alt"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center">
                                        Belum ada data produk.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Bukti Transfer</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <img id="img01" class="mx-auto d-block" src="" alt="">
            </div>
        </div>
    </div>
</div>



@endsection

@section('addon-script')
<script src="{{ url('assets/modules/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ url('assets/modules/datatables/datatables.min.js') }}"></script>
<script src="{{ url('assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ url('assets/modules/izitoast/js/iziToast.min.js') }}"></script>
<script src="{{ url('js/my_datatables.js')}}"></script>
<script src="{{ url('js/my_sweetalert.js')}}"></script>
<script>
    function previewImage(img) {
        var modal = document.getElementById('myModal');
        var modalImg = document.getElementById("img01");
        modal.style.display = "block";
        modalImg.src = img.src;
    }
</script>
@endsection