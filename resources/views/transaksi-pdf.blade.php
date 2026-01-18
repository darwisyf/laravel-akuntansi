@extends('layouts.app')

@section('title', 'Export To PDF')

@section('content')

    <h2>Laporan Transaksi</h2>
    <p>Tanggal Cetak: {{ now()->format('d-m-Y') }}</p>

    <p>
        <strong>Total Debit: </strong> Rp {{ number_format($totalDebit) }} <br>
        <strong>Total Kredit: </strong> Rp {{ number_format($totalKredit) }} <br>
        <strong>Saldo: </strong> Rp {{ number_format($saldo) }}
    </p>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Debit</th>
                <th>Kredit</th>
                <th>Bukti</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksis as $t)
                <tr>
                    <td>{{ $t->tanggal }}</td>
                    <td>{{ $t->keterangan }}</td>
                    <td>{{ number_format($t->debit) }}</td>
                    <td>{{ number_format($t->kredit) }}</td>
                    <td>
                        @if ($t->bukti_pembayaran)
                            <img src="{{ public_path('bukti/' . $t->bukti_pembayaran) }}">
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection