<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TrainingsPendaftarans;
use Illuminate\Support\Str;

class TrainingsPendaftaransController extends Controller
{
    public function store(Request $request)
    {
        $biaya = preg_replace('/[^\d]/', '', $request->input('biaya'));
        $biaya_diskon = preg_replace('/[^\d]/', '', $request->input('biaya_diskon'));
        $total_biaya = preg_replace('/[^\d]/', '', $request->input('total_biaya'));

        // Generate a random 5-character alphanumeric string for id_transaksi
        $id_transaksi = Str::upper(Str::random(5));

        $filename = null;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $directory = public_path('assets/public/img/PendaftaranTraining/');
            if (!file_exists($directory)) {
                mkdir($directory, 0777, true);
            }
            $file->move($directory, $filename);
        }

        $save = TrainingsPendaftarans::create([
            'trainings_id'        => $request->input('trainings_id'),
            'id_transaksi'        => $id_transaksi,
            'name'                => $request->input('name'),
            'telp'                => $request->input('telp'),
            'email'               => $request->input('email'),
            'biaya'               => $biaya,
            'kode_unik_biaya'     => $request->input('kode_unik_biaya'),
            'biaya_diskon'        => $biaya_diskon,
            'total_biaya'         => $total_biaya,
            'lokasi'              => $request->input('lokasi'),
            'metode_pembayaran'   => $request->input('selected_metode_pembayaran'),
            'foto'                => $filename,
        ]);

        if ($save) {
            return redirect()->route('public.training')->with('successcreate', 'Pendaftaran training terkirim, silahkan tunggu info selanjutnya melalui email anda.');
        } else {
            return redirect()->back()->with('errorcreate', 'Gagal menambah data training');
        }
    }
}
