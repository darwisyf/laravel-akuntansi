@extends('layouts.app')

@section('title', 'Input Transaksi')

@section('content')
    <div class="bg-gray-100 min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded-xl shadow-md w-full max-w-lg">
            <h1 class="text-2xl font-bold mb-6 text-center">
                Input Transaksi
            </h1>

            <form method="POST" action="/transaksi" class="space-y-4"> @csrf
                <div>
                    <label class="block text-sm font-medium">Tanggal</label>
                    <input type="date" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" class="w-full mt-1 rounded-md border-gray-300 shadow-sm py-1 px-1">
                </div>
                <div>
                    <label class="block text-sm font-medium">Keterangan</label>
                    <input type="text" name="keterangan" placeholder="Contoh: Beli ATK"
                        class="w-full mt-1 rounded-md border-gray-300 shadow-sm py-1 px-1">
                </div>
                <div>
                    <label class="block text-sm font-medium">Debit</label>
                    <input type="number" name="debit" class="w-full mt-1 rounded-md border-gray-300 shadow-sm py-1 px-1">
                </div>
                <div>
                    <label class="block text-sm font-medium">Kredit</label>
                    <input type="number" name="kredit" class="w-full mt-1 rounded-md border-gray-300 shadow-sm py-1 px-1">
                </div>
                <button type="submit" class="w-full bg-green-500 text-white py-2 rounded-lg hover:bg-green-700">Simpan
                    Transaksi</button>
                <a href="/transaksi-list"
                    class="block text-center border rounded-lg bg-blue-600 hover:bg-blue-700 text-white py-2">Lihat
                    Daftar Transaksi</a>
            </form>
        </div>
    </div>
@endsection