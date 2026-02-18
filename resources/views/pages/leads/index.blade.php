@extends('layouts.app')

@section('content')
    <div class="card card-body py-3">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="d-sm-flex align-items-center justify-space-between">
                    <h4 class="mb-4 mb-sm-0 card-title">List Leads</h4>

                    <nav aria-label="breadcrumb" class="ms-auto">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item d-flex align-items-center">
                                <a class="text-muted text-decoration-none d-flex" href="/">
                                    <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                                    Leads
                                </span>
                            </li>
                        </ol>
                    </nav>

                </div>
            </div>
        </div>
    </div>
    <div class="card w-100 position-relative overflow-hidden">
        <div class="px-4 py-3 border-bottom d-flex align-items-center justify-content-between">
            <h4 class="card-title mb-0">Daftar Lead</h4>
            <a href="{{ route('leads.create') }}" class="btn btn-primary">
                <i class="ti ti-plus"></i> Tambah Lead
            </a>
        </div>


        <div class="card-body p-4">

            <div class="table-responsive mb-4 border rounded-1">
                <table class="table text-nowrap mb-0 align-middle">

                    <thead class="text-dark fs-4">
                        <tr>
                            <th>
                                <h6 class="fs-4 fw-semibold mb-0">Nama</h6>
                            </th>
                            <th>
                                <h6 class="fs-4 fw-semibold mb-0">Email</h6>
                            </th>
                            <th>
                                <h6 class="fs-4 fw-semibold mb-0">Telepon</h6>
                            </th>
                            <th>
                                <h6 class="fs-4 fw-semibold mb-0">Produk</h6>
                            </th>
                            <th>
                                <h6 class="fs-4 fw-semibold mb-0">Skor</h6>
                            </th>
                            <th>
                                <h6 class="fs-4 fw-semibold mb-0">Status</h6>
                            </th>
                            <th>
                                <h6 class="fs-4 fw-semibold mb-0">Aksi</h6>
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($leads as $lead)
                            <tr>

                                <td>
                                    <h6 class="fw-semibold mb-0">
                                        {{ $lead->name }}
                                    </h6>
                                </td>


                                <td>
                                    <span class="fw-normal">
                                        {{ $lead->email }}
                                    </span>
                                </td>


                                <td>
                                    <span class="fw-normal">
                                        {{ $lead->phone }}
                                    </span>
                                </td>

                                <td>
                                    <span class="fw-normal">
                                        {{ $lead->product_interest }}
                                    </span>
                                </td>


                                <td>
                                    <span class="fw-semibold">
                                        {{ $lead->score }}
                                    </span>
                                </td>

                                <td>
                                    @php
                                        $statusClass = match ($lead->status) {
                                            'New' => 'bg-primary-subtle text-primary',
                                            'Processing' => 'bg-warning-subtle text-warning',
                                            'Closed' => 'bg-success-subtle text-success',
                                            default => 'bg-secondary-subtle text-secondary',
                                        };
                                    @endphp

                                    <span class="badge {{ $statusClass }}">
                                        {{ $lead->status }}
                                    </span>
                                </td>
                                <td>
                                    <div class="dropdown dropstart">
                                        <a href="#" class="text-muted" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <i class="ti ti-dots-vertical fs-6"></i>
                                        </a>

                                        <ul class="dropdown-menu">

                                            {{-- Detail (Optional) --}}
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center gap-2" href="#">
                                                    <i class="ti ti-eye"></i> Detail
                                                </a>
                                            </li>

                                            {{-- Edit --}}
                                            <li>
                                                <a class="dropdown-item d-flex align-items-center gap-2"
                                                    href="{{ route('leads.edit', $lead->id) }}">
                                                    <i class="ti ti-edit"></i> Edit
                                                </a>
                                            </li>

                                            {{-- Follow Up (hanya jika status New) --}}
                                            @if ($lead->status === \App\Models\Lead::STATUS_NEW)
                                                <li>
                                                    <form action="{{ route('leads.followUp', $lead->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit"
                                                            class="dropdown-item d-flex align-items-center gap-2 text-warning">
                                                            <i class="ti ti-phone-call"></i> Follow Up (+20)
                                                        </button>
                                                    </form>
                                                </li>
                                            @endif

                                            {{-- Deal (hanya jika Processing dan score >=20) --}}
                                            @if ($lead->status === \App\Models\Lead::STATUS_PROCESSING && $lead->score >= 20)
                                                <li>
                                                    <form action="{{ route('leads.deal', $lead->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit"
                                                            class="dropdown-item d-flex align-items-center gap-2 text-success">
                                                            <i class="ti ti-check"></i> Deal (Score → 100)
                                                        </button>
                                                    </form>
                                                </li>
                                            @endif

                                            <li>
                                                <form action="{{ route('leads.destroy', $lead->id) }}" method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus lead ini?')">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                        class="dropdown-item d-flex align-items-center gap-2 text-danger">
                                                        <i class="ti ti-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </li>


                                        </ul>

                                    </div>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    Belum ada data lead.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>
    </div>
@endsection
