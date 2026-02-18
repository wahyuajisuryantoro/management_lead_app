@extends('layouts.app')

@section('content')
    <div class="col-12">
        <div class="card">

            <div class="card-header text-bg-primary">
                <h4 class="mb-0 text-white">Tambah Lead Baru</h4>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger m-3">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('leads.store') }}" method="POST">
                @csrf

                <div class="card-body">

                    <h4 class="card-title mb-4">Informasi Lead</h4>

                    <div class="row pt-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text"
                                       name="name"
                                       class="form-control"
                                       placeholder="Nama calon pelanggan"
                                       value="{{ old('name') }}"
                                       required>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email"
                                       name="email"
                                       class="form-control"
                                       placeholder="example@gmail.com"
                                       value="{{ old('email') }}"
                                       required>
                                <small class="form-control-feedback">
                                    Email harus unik dan tidak boleh duplikat.
                                </small>
                            </div>
                        </div>

                    </div>

                    <div class="row">


                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Telepon</label>
                                <input type="text"
                                       name="phone"
                                       class="form-control"
                                       placeholder="08xxxxxxxxxx"
                                       value="{{ old('phone') }}"
                                       required>
                                <small class="form-control-feedback">
                                    Nomor telepon juga harus unik.
                                </small>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Produk yang Diminati</label>
                                <input type="text"
                                       name="product_interest"
                                       class="form-control"
                                       placeholder="Contoh: Website, Aplikasi, SaaS"
                                       value="{{ old('product_interest') }}"
                                       required>
                            </div>
                        </div>

                    </div>
                    <div class="alert alert-info mt-3">
                        <strong>Catatan:</strong> Status otomatis akan tersimpan sebagai <b>New</b> dan skor awal <b>0</b>.
                    </div>

                </div>
                <div class="form-actions">
                    <div class="card-body border-top">
                        <button type="submit" class="btn btn-primary">
                            <i class="ti ti-device-floppy"></i> Simpan Lead
                        </button>
                        <a href="{{ route('index') }}"
                           class="btn bg-danger-subtle text-danger ms-2">
                            Batal
                        </a>

                    </div>
                </div>

            </form>
        </div>

    </div>
@endsection
