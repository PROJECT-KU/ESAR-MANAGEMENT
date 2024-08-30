<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Trainings;
use Illuminate\Support\Facades\DB;

class TrainingsController extends Controller
{

    public function training(Request $request)
    {
        $query = Trainings::query()
            ->where('status', 'publish'); // Filter by status 'publish'

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('lokasi', 'like', "%{$search}%")
                    ->orWhere('tanggal_mulai', 'like', "%{$search}%")
                    ->orWhere('tanggal_akhir', 'like', "%{$search}%");
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

        $datas = $query->paginate(5); // Pagination without sorting by created_at

        return view('public.trainings.training', ['trainings' => $datas]);
    }

    public function view(Request $request, $id)
    {
        $trainingsData = Trainings::findOrFail($id);
        return view('public.trainings.training-view', compact('trainingsData'));
    }

    // <!--================== PENDAFTARAN TRAINING ==================-->
    public function PendaftaranView(Request $request, $id)
    {
        $trainingsData = Trainings::findOrFail($id);
        $uniqueCode = $this->generateAndSaveUniqueCode();

        // Ensure uniqueCode is numeric
        $uniqueCodeValue = is_numeric($uniqueCode) ? (int) $uniqueCode : 0;

        // Retrieve the discount from the session and ensure it's numeric
        $biayaDiskon = is_numeric(session('discount_value')) ? (int) session('discount_value') : 0;

        // Calculate subtotal
        $subtotal = $trainingsData->biaya + $uniqueCodeValue;

        // Calculate totalBiaya, apply discount only if it's not zero
        $totalBiaya = $subtotal - $biayaDiskon;

        return view('public.trainings.pendaftaran-view', compact('trainingsData', 'uniqueCode', 'subtotal', 'totalBiaya'));
    }

    private function generateAndSaveUniqueCode()
    {
        do {
            $code = rand(100, 999);
            $existingCode = DB::table('trainings_pendaftarans')->where('kode_unik_biaya', $code)->first();
        } while ($existingCode);
        return $code;
    }

    public function checkPromoCode(Request $request, $id)
    {
        $promoCode = $request->input('name_diskon');
        $training = Trainings::find($id);

        if (!$training) {
            return redirect()->route('public.training.pendaftaran.view', ['id' => $id])
                ->with('discount_value', 0)
                ->with('error', 'Training not found');
        }

        if ($training->name_diskon === $promoCode) {
            $discount = $training->biaya_diskon;
            return redirect()->route('public.training.pendaftaran.view', ['id' => $id])
                ->with('discount_value', $discount)
                ->with('successpromo', 'Promo berhasil di tambahkan');
        } else {
            return redirect()->route('public.training.pendaftaran.view', ['id' => $id])
                ->with('discount_value', 0)
                ->with('error', 'Promo tidak tersedia');
        }
    }
    // <!--================== END ==================-->
}
