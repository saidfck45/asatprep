@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0 d-flex flex-wrap justify-content-between align-items-center gap-3">
                <div>
                    <h6 class="mb-0">Parking Transactions History</h6>
                    <p class="text-xs text-secondary mb-0">Daftar seluruh riwayat kendaraan masuk dan keluar &mdash; Tiket PDF selalu tersedia</p>
                </div>
                
                <!-- Search Bar styled with Soft UI Design -->
                <div class="d-flex align-items-center gap-3 flex-wrap">
                    <div class="input-group input-group-sm" style="max-width: 260px;">
                        <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                        <input type="text" id="tableSearch" class="form-control form-control-sm" placeholder="Cari nomor tiket, plat, lokasi...">
                    </div>

                    <!-- Filter Status -->
                    <div class="btn-group btn-group-sm" role="group">
                        <button type="button" class="btn btn-outline-secondary filter-btn active" data-filter="all">Semua</button>
                        <button type="button" class="btn btn-outline-warning filter-btn" data-filter="parked">Parked</button>
                        <button type="button" class="btn btn-outline-success filter-btn" data-filter="exited">Exited</button>
                    </div>

                    <a href="{{ route('transactions.index') }}" class="btn bg-gradient-secondary btn-sm mb-0">
                        <i class="fa-solid fa-arrow-left me-1"></i> Back to Dashboard
                    </a>
                </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0" id="transactionsTable">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Ticket Number</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Location</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Vehicle Type</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Plate Number</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Entry Time</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Exit Time</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Duration</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Fee</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tiket PDF</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transactions as $index => $tx)
                                <tr data-status="{{ $tx->status }}">
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0 ps-3 index-number">{{ $index + 1 }}</p>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm ticket-cell">{{ $tx->ticket_number }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0 location-cell">{{ $tx->location->name }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0 type-cell">{{ $tx->vehicleType->name }}</p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="badge badge-sm bg-gradient-dark plate-cell">{{ $tx->plate_number ?? '-' }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $tx->entry_time->format('d/m/Y H:i') }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $tx->exit_time ? $tx->exit_time->format('d/m/Y H:i') : '-' }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $tx->duration_hours ? $tx->duration_hours . ' Jam' : '-' }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        @if($tx->total_fee !== null)
                                            <span class="text-success text-xs font-weight-bold">Rp {{ number_format($tx->total_fee, 0, ',', '.') }}</span>
                                        @else
                                            <span class="text-secondary text-xs font-weight-bold">-</span>
                                        @endif
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        @if($tx->status == 'parked')
                                            <span class="badge badge-sm bg-gradient-warning status-cell">Parked</span>
                                        @else
                                            <span class="badge badge-sm bg-gradient-success status-cell">Exited</span>
                                        @endif
                                    </td>
                                    <td class="align-middle text-center">
                                        {{-- Always accessible via downloadTicket route; auto-regenerates if file missing --}}
                                        <a href="{{ route('transactions.download-ticket', $tx->ticket_number) }}" 
                                           target="_blank" 
                                           class="btn btn-sm btn-outline-danger px-2 py-1 mb-0"
                                           title="Buka / Download Tiket PDF {{ $tx->ticket_number }}"
                                           style="border-radius: 6px;">
                                            <i class="fa-solid fa-file-pdf me-1"></i>
                                            <span class="text-xxs font-weight-bold">PDF</span>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr class="no-data-row">
                                    <td colspan="11" class="text-center py-4">
                                        <i class="fa-solid fa-inbox text-secondary opacity-5" style="font-size: 2rem;"></i>
                                        <p class="text-xs text-secondary mb-0 mt-2">Belum ada transaksi parkir.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Count summary bar -->
                <div class="px-4 pt-3 pb-1 d-flex gap-3 align-items-center">
                    <span class="text-xs text-secondary">
                        Total: <strong id="totalCount">{{ $transactions->count() }}</strong> transaksi
                    </span>
                    <span class="text-xs text-secondary" id="filteredInfo" style="display:none;">
                        &mdash; Menampilkan: <strong id="shownCount">0</strong>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {

        // ─── SEARCH FILTER ───────────────────────────────────────────
        $('#tableSearch').on('keyup', function() {
            applyFilters();
        });

        // ─── STATUS FILTER BUTTONS ───────────────────────────────────
        $('.filter-btn').on('click', function() {
            $('.filter-btn').removeClass('active');
            $(this).addClass('active');
            applyFilters();
        });

        function applyFilters() {
            var searchValue  = $('#tableSearch').val().toLowerCase();
            var statusFilter = $('.filter-btn.active').data('filter');
            var visibleRows  = 0;

            $('.search-no-data-row').remove();

            $('#transactionsTable tbody tr').not('.no-data-row').each(function() {
                var rowText   = $(this).text().toLowerCase();
                var rowStatus = $(this).data('status');

                var matchSearch = (searchValue === '' || rowText.indexOf(searchValue) > -1);
                var matchStatus = (statusFilter === 'all' || rowStatus === statusFilter);

                if (matchSearch && matchStatus) {
                    $(this).show();
                    visibleRows++;
                } else {
                    $(this).hide();
                }
            });

            // Re-number visible rows
            var idx = 1;
            $('#transactionsTable tbody tr:visible').not('.no-data-row').each(function() {
                $(this).find('.index-number').text(idx++);
            });

            // Show "no result" row if needed
            var totalDataRows = $('#transactionsTable tbody tr').not('.no-data-row').length;
            if (visibleRows === 0 && totalDataRows > 0) {
                $('#transactionsTable tbody').append(
                    '<tr class="search-no-data-row"><td colspan="11" class="text-center py-4">' +
                    '<i class="fa-solid fa-magnifying-glass text-secondary opacity-5" style="font-size:1.5rem;"></i>' +
                    '<p class="text-xs text-secondary mb-0 mt-2">Data tidak ditemukan untuk pencarian ini.</p>' +
                    '</td></tr>'
                );
            }

            // Update count bar
            if (searchValue !== '' || statusFilter !== 'all') {
                $('#shownCount').text(visibleRows);
                $('#filteredInfo').show();
            } else {
                $('#filteredInfo').hide();
            }
        }
    });
</script>
@endsection
