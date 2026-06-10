@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">

        {{-- ── HEADER ROW ── --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h5 class="font-weight-bolder mb-0" style="color:#252f40;">
                    &#x1F4CD; Data Lokasi Parkir
                </h5>
                <p class="text-sm text-secondary mb-0">Kelola gedung dan kapasitas parkir per jenis kendaraan</p>
            </div>
            <a href="{{ route('locations.create') }}"
               class="btn btn-sm mb-0 text-white font-weight-bold px-4"
               style="background: linear-gradient(310deg,#7928CA,#FF0080); border-radius: 10px;">
                &#xff0b; Tambah Lokasi
            </a>
        </div>

        {{-- ── SUCCESS ALERT ── --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show text-white mb-4" role="alert">
                <strong>&#x2714; Berhasil!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- ── LOCATION CARDS ── --}}
        <div class="row g-4">
            @forelse($locations as $index => $location)
            <div class="col-xl-4 col-md-6">
                <div class="card h-100 border-0" style="border-radius:1.25rem; box-shadow:0 8px 32px rgba(121,40,202,0.08);">
                    <div class="card-body p-4">

                        {{-- Card Top: Icon + Name --}}
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="d-flex align-items-center justify-content-center flex-shrink-0"
                                 style="width:52px;height:52px;border-radius:14px;background:linear-gradient(135deg,#FF007F,#7928CA);box-shadow:0 4px 15px rgba(121,40,202,0.3);">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white" viewBox="0 0 24 24">
                                    <path d="M3 21V7a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v14M3 21h18M9 21v-6h6v6"/>
                                </svg>
                            </div>
                            <div>
                                <h6 class="mb-0 font-weight-bolder" style="font-size:1rem;color:#252f40;">{{ $location->name }}</h6>
                                <span class="text-xxs text-secondary font-weight-bold text-uppercase">Lokasi #{{ $index + 1 }}</span>
                            </div>
                        </div>

                        <hr class="horizontal dark my-3">

                        {{-- Capacity Section --}}
                        <p class="text-xxs text-secondary text-uppercase font-weight-bold mb-2" style="letter-spacing:1px;">Kapasitas Slot</p>

                        <div class="row g-2 mb-3">
                            {{-- Motor --}}
                            <div class="col-4">
                                <div class="text-center p-2 rounded-3" style="background:#f0fdf4;">
                                    <div class="mb-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="#16a34a" stroke-width="1.8">
                                            <circle cx="5.5" cy="17.5" r="2.5"/><circle cx="18.5" cy="17.5" r="2.5"/>
                                            <path d="M8 17.5h7M15 17.5l-1-5H9l-2 3h1M12 12.5l1-5h3l1 2"/>
                                        </svg>
                                    </div>
                                    <div class="font-weight-bolder" style="font-size:1.1rem;color:#16a34a;">{{ $location->capacity_motor }}</div>
                                    <div class="text-xxs text-secondary font-weight-bold">Motor</div>
                                </div>
                            </div>
                            {{-- Mobil --}}
                            <div class="col-4">
                                <div class="text-center p-2 rounded-3" style="background:#eff6ff;">
                                    <div class="mb-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="#2563eb" stroke-width="1.8">
                                            <path d="M5 17H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h13l4 4v4a2 2 0 0 1-2 2h-1"/>
                                            <circle cx="7.5" cy="17.5" r="1.5"/><circle cx="17.5" cy="17.5" r="1.5"/>
                                        </svg>
                                    </div>
                                    <div class="font-weight-bolder" style="font-size:1.1rem;color:#2563eb;">{{ $location->capacity_car }}</div>
                                    <div class="text-xxs text-secondary font-weight-bold">Mobil</div>
                                </div>
                            </div>
                            {{-- Truck --}}
                            <div class="col-4">
                                <div class="text-center p-2 rounded-3" style="background:#fff7ed;">
                                    <div class="mb-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="#ea580c" stroke-width="1.8">
                                            <path d="M1 3h15v13H1zM16 8h4l3 3v5h-7V8z"/>
                                            <circle cx="5.5" cy="18.5" r="1.5"/><circle cx="18.5" cy="18.5" r="1.5"/>
                                        </svg>
                                    </div>
                                    <div class="font-weight-bolder" style="font-size:1.1rem;color:#ea580c;">{{ $location->capacity_truck }}</div>
                                    <div class="text-xxs text-secondary font-weight-bold">Truck</div>
                                </div>
                            </div>
                        </div>

                        {{-- Total capacity badge --}}
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="text-xxs text-secondary font-weight-bold">
                                Total Kapasitas:
                                <strong class="text-dark">{{ $location->capacity_motor + $location->capacity_car + $location->capacity_truck }} slot</strong>
                            </span>
                            <div class="d-flex gap-2">
                                <a href="{{ route('locations.edit', $location->id) }}"
                                   class="btn btn-sm mb-0 px-3 py-1"
                                   style="background:#fef9c3;color:#854d0e;border-radius:8px;font-size:0.7rem;font-weight:700;">
                                    &#x270E; Edit
                                </a>
                                <form action="{{ route('locations.destroy', $location->id) }}" method="POST" class="delete-form d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-sm mb-0 px-3 py-1"
                                            style="background:#fee2e2;color:#991b1b;border-radius:8px;font-size:0.7rem;font-weight:700;border:none;">
                                        &#x1F5D1; Hapus
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="card border-0 text-center py-5" style="border-radius:1.25rem;">
                    <div class="card-body">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="none" viewBox="0 0 24 24" stroke="#d1d5db" stroke-width="1.5" class="mb-3">
                            <path d="M3 21V7a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v14M3 21h18"/>
                        </svg>
                        <p class="text-secondary mb-1">Belum ada data lokasi.</p>
                        <a href="{{ route('locations.create') }}" class="btn btn-sm text-white" style="background:linear-gradient(310deg,#7928CA,#FF0080);border-radius:8px;">
                            + Tambah Lokasi Pertama
                        </a>
                    </div>
                </div>
            </div>
            @endforelse
        </div>

    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('.delete-form').on('submit', function(e) {
            e.preventDefault();
            const form = this;
            Swal.fire({
                title: 'Hapus Lokasi?',
                text: "Data lokasi dan seluruh transaksi terkait akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ea0606',
                cancelButtonColor: '#82d616',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) form.submit();
            });
        });
    });
</script>
@endsection
