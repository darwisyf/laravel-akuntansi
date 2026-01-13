@extends('layouts.app')

@section('title', 'Edit Transaksi')

@section('content')
    <div class="max-w-lg mx-auto bg-white p-6 rounded-xl shadow">
        <h1 class="text-xl font-bold mb-4">Edit Transaksi</h1>

        <form method="POST" action="/transaksi/{{ $transaksis->id }}" enctype="multipart/form-data"> @csrf @method('PUT')
            <input type="date" name="tanggal" value="{{ $transaksis->tanggal }}" class="w-full mb-3 border rounded p-2">
            <input type="text" name="keterangan" value="{{ $transaksis->keterangan }}"
                class="w-full mb-3 border rounded p-2">
            <input type="number" name="debit" value="{{ $transaksis->debit }}" class="w-full mb-3 border rounded p-2">
            <input type="number" name="kredit" value="{{ $transaksis->kredit }}" class="w-full mb-3 border rounded p-2">

            @if ($transaksis->bukti_pembayaran)
                <img src="{{ asset('bukti/' . $transaksis->bukti_pembayaran) }}" width="120" class="rounded mb-2">
            @endif

            <input type="file" name="bukti_pembayaran" class="border p-2">

            <button class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700"
                onsubmit="return alert('Data Berhasil diupdate')">Update Transaksi</button>
        </form>
    </div>
@endsection