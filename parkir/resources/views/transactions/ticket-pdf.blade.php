<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tiket Parkir - {{ $transaction->ticket_number }}</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Courier New', Courier, monospace;
            width: 310px;
            margin: 0 auto;
            padding: 12px;
            color: #111;
            background: #fff;
            font-size: 12px;
        }
        .header {
            text-align: center;
            border-bottom: 2px dashed #333;
            padding-bottom: 10px;
            margin-bottom: 12px;
        }
        .header h2 {
            font-size: 16px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        .header p {
            font-size: 10px;
            margin-top: 2px;
            color: #555;
        }
        .status-badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 6px;
        }
        .status-parked  { background: #fff3cd; color: #856404; border: 1px solid #ffc107; }
        .status-exited  { background: #d1e7dd; color: #0a3622; border: 1px solid #198754; }
        .ticket-num {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            letter-spacing: 2px;
            margin: 12px 0;
            border: 1px solid #333;
            padding: 8px;
            background-color: #f5f5f5;
        }
        .section-title {
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #888;
            border-bottom: 1px solid #eee;
            margin-bottom: 6px;
            padding-bottom: 3px;
        }
        .details {
            margin-bottom: 10px;
        }
        .details table {
            width: 100%;
        }
        .details td {
            padding: 3px 0;
            vertical-align: top;
            font-size: 11px;
        }
        .details td.label {
            width: 45%;
            font-weight: bold;
            color: #444;
        }
        .exit-section {
            background: #f0fff4;
            border: 1px dashed #198754;
            border-radius: 4px;
            padding: 8px;
            margin-bottom: 10px;
        }
        .exit-section .section-title { color: #198754; border-color: #b2dfdb; }
        .total-fee {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            color: #198754;
            margin-top: 6px;
        }
        .barcode {
            text-align: center;
            margin: 12px 0 8px;
            font-size: 9px;
            letter-spacing: 2px;
        }
        .barcode-lines {
            height: 28px;
            background: repeating-linear-gradient(
                90deg,
                #000 0px, #000 2px,
                #fff 2px, #fff 4px,
                #000 4px, #000 5px,
                #fff 5px, #fff 8px,
                #000 8px, #000 11px,
                #fff 11px, #fff 13px
            );
            width: 75%;
            margin: 0 auto 4px;
        }
        .footer {
            text-align: center;
            border-top: 2px dashed #333;
            padding-top: 8px;
            margin-top: 8px;
            font-size: 10px;
            color: #666;
            line-height: 1.6;
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>&#x1F17F; Tiket Parkir Kendaraan</h2>
        <p>SMKN 1 CIBINONG &mdash; ASAT PRAKTEK</p>
        <div>
            <span class="status-badge {{ $transaction->status === 'exited' ? 'status-exited' : 'status-parked' }}">
                {{ $transaction->status === 'exited' ? '&#x2714; Sudah Keluar' : '&#x23F3; Sedang Parkir' }}
            </span>
        </div>
    </div>

    <div class="ticket-num">
        {{ $transaction->ticket_number }}
    </div>

    {{-- ENTRY INFO --}}
    <div class="details">
        <div class="section-title">Informasi Masuk</div>
        <table>
            <tr>
                <td class="label">Lokasi:</td>
                <td>{{ $transaction->location->name }}</td>
            </tr>
            <tr>
                <td class="label">Jenis Kendaraan:</td>
                <td>{{ $transaction->vehicleType->name }}</td>
            </tr>
            <tr>
                <td class="label">Waktu Masuk:</td>
                <td>{{ $transaction->entry_time->format('d-m-Y H:i:s') }}</td>
            </tr>
            @if($transaction->plate_number)
            <tr>
                <td class="label">Plat Nomor:</td>
                <td><strong>{{ $transaction->plate_number }}</strong></td>
            </tr>
            @endif
        </table>
    </div>

    {{-- EXIT INFO (only shown when exited) --}}
    @if($transaction->status === 'exited')
    <div class="exit-section">
        <div class="section-title">Informasi Keluar & Pembayaran</div>
        <table>
            <tr>
                <td class="label">Waktu Keluar:</td>
                <td>{{ $transaction->exit_time ? $transaction->exit_time->format('d-m-Y H:i:s') : '-' }}</td>
            </tr>
            <tr>
                <td class="label">Durasi Parkir:</td>
                <td>{{ $transaction->duration_hours }} Jam</td>
            </tr>
        </table>
        <div class="total-fee">
            Rp {{ number_format($transaction->total_fee, 0, ',', '.') }}
        </div>
    </div>
    @endif

    <div class="barcode">
        <div class="barcode-lines"></div>
        *{{ $transaction->ticket_number }}*
    </div>

    <div class="footer">
        @if($transaction->status === 'parked')
            <p>Simpan tiket ini dengan baik.</p>
            <p>Tunjukkan saat keluar untuk pembayaran.</p>
        @else
            <p>Transaksi selesai. Terima kasih!</p>
        @endif
        <p style="margin-top:4px; font-size:9px; color:#aaa;">
            Dicetak: {{ now()->format('d-m-Y H:i:s') }}
        </p>
    </div>

</body>
</html>
