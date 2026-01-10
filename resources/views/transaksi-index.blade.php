@extends('layouts.app')

@section('title', 'Daftar Transaksi')

@section('content')
<h1 class="text-2xl font-bold mb-4">Daftar Transaksi</h1>

    <div class="grid grid-cols-3 gap-4 mb-6">
        <div class="p-4 bg-green-100 rounded">
            <p class="text-sm">Total Debit</p>
            <p class="text-lg font-bold">Rp {{ number_format($totalDebit) }}</p>
        </div>

        <div class="p-4 bg-red-100 rounded">
            <p class="text-sm">Total Kredit</p>
            <p class="text-lg font-bold">Rp {{ number_format($totalKredit) }}</p>
        </div>
    
        <div class="p-4 bg-blue-100 rounded">
            <p class="text-sm">Saldo</p>
            <p class="text-lg font-bold">Rp {{ number_format($saldo) }}</p>
        </div>
    </div>


    <form method="GET" action="/transaksi-list" class="flex gap-4 mb-6 items-center">
        <div>
            <label class="text-sm">Dari Tanggal</label>
            <input type="date" name="from" value="{{ request('from') }}" class="border px-2 py-1 rounded">
        </div>

        <div>
            <label class="text-sm">Sampai Tanggal</label>
            <input type="date" name="to" value="{{ request('to') }}" class="border px-2 py-1 rounded">
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">Filter</button>

        <form method="GET" action="/transaksi-list" class="flex gap-4 mb-6">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari keterangan..." class="border px-3 py-2 rounded w-64">
            <button class="bg-gray-700 text-white px-4 py-2 rounded">
                Cari
            </button>
        </form>
    </form>

        <table class="min-w-full bg-white rounded shadow">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2">Tanggal</th>
                    <th class="px-4 py-2">Keterangan</th>
                    <th class="px-4 py-2">Debit</th>
                    <th class="px-4 py-2">Kredit</th>
                    <th colspan="2" class="px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transaksis as $t)
                    <tr>
                        <td class="px-4 py-2">{{ $t->tanggal }}</td>
                        <td class="px-4 py-2">{{ $t->keterangan }}</td>
                        <td class="px-4 py-2">{{ number_format($t->debit) }}</td>
                        <td class="px-4 py-2">{{ number_format($t->kredit) }}</td>
                        <td class="px-4 py-2 text-center"><a href="/transaksi/{{ $t->id }}/edit"
                                class="text-blue-600">Edit</a>
                        </td>
                        <td class="border-y px-4 py-2 text-center">
                            <form action="/transaksi/{{ $t->id }}" method="POST"
                                onsubmit="return confirm('Yakin mau hapus?')"> @csrf @method('DELETE')
                                <button class="text-red-600 hover:cursor-pointer">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center p-4">
                            Belum ada transaksi
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">
            {{ $transaksis->links() }}
        </div>
@endsection