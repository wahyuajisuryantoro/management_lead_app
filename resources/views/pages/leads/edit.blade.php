@extends('layouts.app')

@section('content')
<div class="col-12">

    <div class="card">

        <div class="card-header text-bg-warning">
            <h4 class="mb-0 text-white">Edit Lead</h4>
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

        <form action="{{ route('leads.update', $lead->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="card-body">
                <h4 class="card-title mb-4">Update Informasi Lead</h4>

                <div class="row">


                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text"
                               name="name"
                               class="form-control"
                               value="{{ old('name', $lead->name) }}"
                               required>
                    </div>


                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email</label>
                        <input type="email"
                               name="email"
                               class="form-control"
                               value="{{ old('email', $lead->email) }}"
                               required>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Telepon</label>
                        <input type="text"
                               name="phone"
                               class="form-control"
                               value="{{ old('phone', $lead->phone) }}"
                               required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Produk yang Diminati</label>
                        <input type="text"
                               name="product_interest"
                               class="form-control"
                               value="{{ old('product_interest', $lead->product_interest) }}"
                               required>
                    </div>

                </div>

                <div class="alert alert-info mt-3">
                    Status: <b>{{ $lead->status }}</b> |
                    Score: <b>{{ $lead->score }}</b>
                </div>

            </div>

            <div class="card-body border-top">
                <button type="submit" class="btn btn-warning text-white">
                    <i class="ti ti-edit"></i> Update Lead
                </button>

                <a href="{{ route('index') }}" class="btn btn-light ms-2">
                    Batal
                </a>
            </div>

        </form>

    </div>
</div>
@endsection
