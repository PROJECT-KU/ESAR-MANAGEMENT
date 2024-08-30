<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Trainings;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationCodeMail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DataTrainingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    // <!--================== MENAMPILKAN DATA ==================-->
    public function index(Request $request)
    {
        $query = Trainings::query();
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('name_diskon', 'like', "%{$search}%")
                    ->orWhere('status', 'like', "%{$search}%");
            });
        }

        if ($request->has('sort_by')) {
            $sortBy = $request->input('sort_by');
            if ($sortBy == 'latest') {
                $query->orderBy('created_at', 'desc');
            } elseif ($sortBy == 'oldest') {
                $query->orderBy('created_at', 'asc');
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $datas = $query->paginate(10);
        return view('admin.training.index', ['trainings' => $datas]);
    }

    // <!--================== END ==================-->

    // <!--================== TAMBAH DATA ==================-->
    public function create(Request $request)
    {
        $query = Trainings::query();
        return view('admin.training.create');
    }

    public function store(Request $request)
    {
        $filename = null;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $directory = public_path('assets/public/img/training/');
            if (!file_exists($directory)) {
                mkdir($directory, 0777, true);
            }
            $file->move($directory, $filename);
        }

        $biaya = preg_replace('/[^\d]/', '', $request->input('biaya'));
        $biaya_diskon = preg_replace('/[^\d]/', '', $request->input('biaya_diskon'));

        $save = Trainings::create([
            'name'          => $request->input('name'),
            'tanggal_mulai' => $request->input('tanggal_mulai'),
            'tanggal_akhir' => $request->input('tanggal_akhir'),
            'lokasi'        => $request->input('lokasi'),
            'status'        => $request->input('status'),
            'deskripsi'     => $request->input('deskripsi'),
            'biaya'         => $biaya,
            'name_diskon'   => $request->input('name_diskon'),
            'biaya_diskon'  => $biaya_diskon,
            'foto'          => $filename,
        ]);

        if ($save) {
            return redirect()->route('auth.view.trainings')->with('successcreate', 'Berhasil menambah data training');
        } else {
            return redirect()->route('auth.view.trainings')->with('errorcreate', 'Gagal menambah data training');
        }
    }
    // <!--================== END ==================-->

    // <!--================== EDIT DATA ==================-->
    public function edit(Request $request, $id)
    {
        $trainingsData = Trainings::findOrFail($id);
        return view('admin.training.edit', compact('trainingsData'));
    }
    public function update(Request $request, $id)
    {
        $trainingsData = Trainings::findOrFail($id);

        if ($request->hasFile('foto')) {
            $oldPhoto = $trainingsData->foto;
            if ($oldPhoto && file_exists(public_path('assets/public/img/training/' . $oldPhoto))) {
                unlink(public_path('assets/public/img/training/' . $oldPhoto));
            }

            $file = $request->file('foto');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $directory = public_path('assets/public/img/training/');
            if (!file_exists($directory)) {
                mkdir($directory, 0777, true);
            }
            $file->move($directory, $filename);
            $trainingsData->foto = $filename;
        }

        $biaya = preg_replace('/[^\d]/', '', $request->input('biaya'));
        $biaya_diskon = preg_replace('/[^\d]/', '', $request->input('biaya_diskon'));

        $trainingsData->name = $request->input('name');
        $trainingsData->tanggal_mulai = $request->input('tanggal_mulai');
        $trainingsData->tanggal_akhir = $request->input('tanggal_akhir');
        $trainingsData->lokasi = $request->input('lokasi');
        $trainingsData->status = $request->input('status');
        $trainingsData->deskripsi = $request->input('deskripsi');
        $trainingsData->biaya = $biaya;
        $trainingsData->name_diskon = $request->input('name_diskon');
        $trainingsData->biaya_diskon = $biaya_diskon;

        if ($trainingsData->save()) {
            return redirect()->back()->with('successupdate', 'Berhasil mengupdate data training');
        } else {
            return redirect()->back()->with('errorupdate', 'Gagal mengupdate data training');
        }
    }

    // <!--================== END ==================-->

    // <!--================== DELETE DATA ==================-->
    public function destroy(Request $request, $id)
    {
        $trainingsData = Trainings::findOrFail($id);

        // Delete the associated photo if it exists
        if ($trainingsData->foto && file_exists(public_path('assets/public/img/training/' . $trainingsData->foto))) {
            unlink(public_path('assets/public/img/training/' . $trainingsData->foto));
        }

        // Delete the user record
        $trainingsData->delete();

        return redirect()->route('auth.view.trainings')->with('statusdatadeleted', 'Data pengguna berhasil dihapus.');
    }
    // <!--================== END ==================-->
}
