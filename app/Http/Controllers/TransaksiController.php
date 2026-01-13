<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use Illuminate\Support\Facades\File;
class TransaksiController extends Controller
{
    public function store(Request $request) {
        $request ->validate([
            'tanggal'=> 'required|date',
            'keterangan'=> 'required',
            'debit'=> 'nullable|numeric',
            'kredit'=> 'nullable|numeric',
            'bukti_pembayaran'=> 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $namaFile = null;

        if($request->hasFile('bukti_pembayaran')){
            $namaFile = time() . '.' . $request->bukti_pembayaran->extension();
            $request->bukti_pembayaran->move(public_path('bukti'), $namaFile);
        }

        Transaksi::create([
            'user_id'=> auth()->id(),
            'tanggal'=> $request -> tanggal,
            'keterangan'=> $request -> keterangan,
            'debit'=> $request -> debit ?? 0,
            'kredit'=> $request -> kredit ?? 0,
            'bukti_pembayaran'=> $namaFile,
        ]);

        return redirect('/transaksi')->with('success','Transaksi berhasil disimpan');
    }

    public function index(Request $request) {

        $query = Transaksi::where('user_id', auth()->id());

        // Search
        if($request->search) {
            $query->where('keterangan', 'like','%'. $request->search .'%');
        }

        // Filter Tanggal
        if($request->from && $request->to) {
            $query->whereBetween('tanggal', [$request->from, $request->to]);
        }

        // Pagination
        $transaksis = $query->orderBy('tanggal','desc')->paginate(10)->withQueryString();

        // Hitung Total Debit, Kredit dan Saldo
        $totalDebit = $transaksis->sum('debit');
        $totalKredit = $transaksis->sum('kredit');
        $saldo = $totalDebit - $totalKredit;

        return view('transaksi-index', compact('transaksis', 'totalDebit','totalKredit', 'saldo'));
    }

    public function edit($id) {        

        $transaksis = Transaksi::where('id',$id)->where('user_id',auth()->id())->firstOrFail();

        if ($transaksis->user_id !== auth()->id()) {
            abort(403);
        }

        return view('transaksi-edit', compact('transaksis'));
    }

    public function update(Request $request, $id) {
        $transaksis = Transaksi::where('id',$id)->where('user_id',auth()->id())->firstOrFail();

        if ($transaksis->user_id !== auth()->id()) {
            abort(403);
        }

        $request ->validate([
            'tanggal'=> 'required|date',
            'keterangan'=> 'required',
            'debit'=> 'nullable|numeric',
            'kredit'=> 'nullable|numeric',
            'bukti_pembayaran'=> 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('bukti_pembayaran')) {
            if ($transaksis->bukti_pembayaran) {
                $oldPath = public_path('bukti/'. $transaksis->bukti_pembayaran);
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
            }
            $namaFile = uniqid() . '.' . $request->bukti_pembayaran->extension();
            $request->bukti_pembayaran->move(public_path('bukti'), $namaFile);
            $transaksis->bukti_pembayaran = $namaFile;
        }
        

        $transaksis -> update([
            'tanggal'=> $request -> tanggal,
            'keterangan'=> $request -> keterangan,
            'debit'=> $request -> debit,
            'kredit'=> $request -> kredit,
        ]);

        return redirect('/transaksi-list')->with('success','Transaksi berhasil diupdate');
    }

    public function destroy($id) {
        $transaksis = Transaksi::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        if($transaksis->bukti_pembayaran) {
            $path = public_path('bukti/' . $transaksis->bukti_pembayaran);

            if(file_exists($path)) {
                File::delete($path);
            };
        }

        $transaksis->delete();

        return redirect('/transaksi-list')->with('success','Transaksi berhasil dihapus');
    }
}
