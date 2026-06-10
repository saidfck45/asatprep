@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">

        {{-- ── HEADER ROW ── --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h5 class="font-weight-bolder mb-0" style="color:#252f40;">
                    &#x1F697; Data Jenis Kendaraan & Tarif
                </h5>
                <p class="text-sm text-secondary mb-0">Kelola jenis kendaraan beserta tarif parkir per jam dan per hari</p>
            </div>
            <a href="{{ route('vehicle-types.create') }}"
               class="btn btn-sm mb-0 text-white font-weight-bold px-4"
               style="background: linear-gradient(310deg,#1171EF,#11CDEF); border-radius: 10px;">
                &#xff0b; Tambah Jenis
            </a>
        </div>

        {{-- ── SUCCESS ALERT ── --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show text-white mb-4" role="alert">
                <strong>&#x2714; Berhasil!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- ── VEHICLE TYPE CARDS ── --}}
        <div class="row g-4">
            @forelse($vehicleTypes as $index => $type)

            @php
                $configs = [
                    'Motor'          => ['gradient'=>'linear-gradient(135deg,#16a34a,#4ade80)', 'bg'=>'#f0fdf4', 'border'=>'#bbf7d0', 'text'=>'#14532d', 'shadow'=>'rgba(22,163,74,0.2)'],
                    'Car'            => ['gradient'=>'linear-gradient(135deg,#2563eb,#60a5fa)', 'bg'=>'#eff6ff', 'border'=>'#bfdbfe', 'text'=>'#1e3a8a', 'shadow'=>'rgba(37,99,235,0.2)'],
                    'Truck/Bus/Other'=> ['gradient'=>'linear-gradient(135deg,#ea580c,#fb923c)', 'bg'=>'#fff7ed', 'border'=>'#fed7aa', 'text'=>'#7c2d12', 'shadow'=>'rgba(234,88,12,0.2)'],
                ];
                $cfg = $configs[$type->name] ?? ['gradient'=>'linear-gradient(135deg,#7928CA,#FF0080)', 'bg'=>'#fdf4ff', 'border'=>'#e9d5ff', 'text'=>'#4c1d95', 'shadow'=>'rgba(121,40,202,0.2)'];
            @endphp

            <div class="col-xl-4 col-md-6">
                <div class="card h-100 border-0" style="border-radius:1.25rem; box-shadow:0 8px 32px {{ $cfg['shadow'] }};">
                    <div class="card-body p-0 overflow-hidden">

                        {{-- Colored Top Banner --}}
                        <div class="d-flex align-items-center gap-3 p-4"
                             style="background:{{ $cfg['gradient'] }}; border-radius:1.25rem 1.25rem 0 0;">
                            @if($type->name === 'Motor')
                            <div style="width:48px;height:48px;background:rgba(255,255,255,0.25);border-radius:12px;display:flex;align-items:center;justify-content:center;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="none" viewBox="0 0 24 24" stroke="white" stroke-width="2">
                                    <circle cx="5.5" cy="17.5" r="2.5"/><circle cx="18.5" cy="17.5" r="2.5"/>
                                    <path d="M8 17.5h7M15 17.5l-1-5H9l-2 3h1M12 12.5l1-5h3l1 2"/>
                                </svg>
                            </div>
                            @elseif($type->name === 'Car')
                            <div style="width:48px;height:48px;background:rgba(255,255,255,0.25);border-radius:12px;display:flex;align-items:center;justify-content:center;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="none" viewBox="0 0 24 24" stroke="white" stroke-width="2">
                                    <path d="M5 17H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h13l4 4v4a2 2 0 0 1-2 2h-1"/>
                                    <circle cx="7.5" cy="17.5" r="1.5"/><circle cx="17.5" cy="17.5" r="1.5"/>
                                </svg>
                            </div>
                            @else
                            <div style="width:48px;height:48px;background:rgba(255,255,255,0.25);border-radius:12px;display:flex;align-items:center;justify-content:center;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="none" viewBox="0 0 24 24" stroke="white" stroke-width="2">
                                    <path d="M1 3h15v13H1zM16 8h4l3 3v5h-7V8z"/>
                                    <circle cx="5.5" cy="18.5" r="1.5"/><circle cx="18.5" cy="18.5" r="1.5"/>
                                </svg>
                            </div>
                            @endif
                            <div>
                                <h6 class="mb-0 font-weight-bolder text-white" style="font-size:1.05rem;">{{ $type->name }}</h6>
                                <span style="font-size:0.7rem;color:rgba(255,255,255,0.8);font-weight:600;text-transform:uppercase;letter-spacing:1px;">
                                    Jenis Kendaraan #{{ $index + 1 }}
                                </span>
                            </div>
                        </div>

                        {{-- Tariff Details --}}
                        <div class="p-4">
                            <p class="text-xxs text-secondary text-uppercase font-weight-bold mb-3" style="letter-spacing:1px;">Struktur Tarif Parkir</p>

                            {{-- Jam Pertama --}}
                            <div class="d-flex justify-content-between align-items-center mb-2 p-3 rounded-3"
                                 style="background:{{ $cfg['bg'] }}; border:1px solid {{ $cfg['border'] }};">
                                <div>
                                    <p class="text-xxs font-weight-bold text-secondary mb-0 text-uppercase">Jam Pertama</p>
                                    <p class="text-xs text-secondary mb-0">Tarif masuk awal</p>
                                </div>
                                <span class="font-weight-bolder" style="font-size:0.95rem;color:{{ $cfg['text'] }};">
                                    Rp {{ number_format($type->perjam_pertama, 0, ',', '.') }}
                                </span>
                            </div>

                            {{-- Jam Berikutnya --}}
                            <div class="d-flex justify-content-between align-items-center mb-2 p-3 rounded-3"
                                 style="background:#f8fafc; border:1px solid #e2e8f0;">
                                <div>
                                    <p class="text-xxs font-weight-bold text-secondary mb-0 text-uppercase">Jam Berikutnya</p>
                                    <p class="text-xs text-secondary mb-0">Per jam setelah jam pertama</p>
                                </div>
                                <span class="font-weight-bolder text-dark" style="font-size:0.95rem;">
                                    Rp {{ number_format($type->perjam_berikutnya, 0, ',', '.') }}
                                </span>
                            </div>

                            {{-- Max Per Hari --}}
                            <div class="d-flex justify-content-between align-items-center mb-3 p-3 rounded-3"
                                 style="background:#fef2f2; border:1px solid #fecaca;">
                                <div>
                                    <p class="text-xxs font-weight-bold text-secondary mb-0 text-uppercase">Maksimal / Hari</p>
                                    <p class="text-xs text-secondary mb-0">Batas tarif harian</p>
                                </div>
                                <span class="font-weight-bolder text-danger" style="font-size:0.95rem;">
                                    Rp {{ number_format($type->max_perhari, 0, ',', '.') }}
                                </span>
                            </div>

                            {{-- Action Buttons --}}
                            <div class="d-flex gap-2">
                                <a href="{{ route('vehicle-types.edit', $type->id) }}"
                                   class="btn btn-sm flex-grow-1 mb-0 font-weight-bold"
                                   style="background:#fef9c3;color:#854d0e;border-radius:8px;font-size:0.72rem;border:1px solid #fde68a;">
                                    &#x270E; Edit Tarif
                                </a>
                                <form action="{{ route('vehicle-types.destroy', $type->id) }}" method="POST" class="delete-form d-inline flex-grow-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-sm w-100 mb-0 font-weight-bold"
                                            style="background:#fee2e2;color:#991b1b;border-radius:8px;font-size:0.72rem;border:1px solid #fecaca;">
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
                            <path d="M5 17H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h13l4 4v4a2 2 0 0 1-2 2h-1"/>
                            <circle cx="7.5" cy="17.5" r="1.5"/><circle cx="17.5" cy="17.5" r="1.5"/>
                        </svg>
                        <p class="text-secondary mb-1">Belum ada data jenis kendaraan.</p>
                        <a href="{{ route('vehicle-types.create') }}" class="btn btn-sm text-white" style="background:linear-gradient(310deg,#1171EF,#11CDEF);border-radius:8px;">
                            + Tambah Jenis Kendaraan
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
                title: 'Hapus Jenis Kendaraan?',
                text: "Data tarif dan seluruh transaksi terkait akan dihapus permanen!",
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
