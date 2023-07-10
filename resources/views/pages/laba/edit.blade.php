@extends('layouts.app')

@section('title', $title)

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
                Halaman untuk mengakumulasi pengeluaran dan pemasukan.
            </p>

            <div class="card">

                <form action="{{ route('laba.update', $items->id) }}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        @if ($errors->any())
                        @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible show fade">
                            <div class="alert-body">
                                <button class="close" data-dismiss="alert">
                                    <span>×</span>
                                </button>
                                {{ $error }}
                            </div>
                        </div>
                        @endforeach
                        @endif

                        <div class="row">

                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label>Tanggal Pengeluaran</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-calendar"></i>
                                            </div>
                                        </div>
                                        <input type="date" class="form-control" name="tgl" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Dibuat Oleh</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="far fa-user"></i>
                                            </div>
                                        </div>
                                        <input type="text" name="user" class="form-control" value="{{ Auth::user()->name }}" readonly>
                                    </div>
                                </div>

                            </div>

                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label>Rincian</label>
                                    <input type="text" class="form-control" name="beban" value="{{$items->beban}}">
                                </div>
                                <div class="form-group">
                                    <label>
                                        Jumlah Beban
                                    </label>

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <b>Rp</b>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control currency" name="jumlah" value="{{$items->jumlah}}" id="jumlah-beban">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Keterangan <br />
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-tag"></i>
                                            </div>
                                        </div>
                                        <select class="form-control" name="keterangan">
                                            <option value="{{$items->keterangan}}">{{$items->keterangan}}</option>
                                            <option value="Tunai">Tunai</option>
                                            <option value="Transfer">Transfer</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="">Bukti Pembayaran</label>
                                    <img src="{{ url('assets/img/image_not_available.png') }}" class="rounded img-responsive" alt="Image Preview" width="100%" id="img-preview">
                                </div>
                                <div class="form-group">
                                    <label class="float-right">
                                        <a href="#" data-toggle="tooltip" title="Klik untuk menghapus foto yang sudah dipilih" style="display:none" id="img-reset">
                                            <code class="text-right">Hapus Foto</code>
                                        </a>
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-file-image"></i>
                                            </div>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="photo" id="img-file">
                                            <label class="custom-file-label" id="img-name">Pilih Foto</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection

@section('addon-script')
<script src="{{ url('assets/modules/cleave-js/dist/cleave.min.js') }}"></script>
<script src="{{ url('assets/modules/cleave-js/dist/addons/cleave-phone.id.js') }}"></script>
<script src="{{ url('js/my_cleave.js') }}"></script>
<script src="{{ url('js/image_upload.js') }}"></script>

@endsection