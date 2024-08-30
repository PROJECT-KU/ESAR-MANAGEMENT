<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationCodeMail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    // <!--================== MENAMPILKAN DATA ==================-->
    public function index()
    {
        $user = Auth::user();
        $userData = User::select(
            'name',
            'username',
            'email',
            'alamat',
            'telp',
            'email_verified_at',
            'code_verified_mail',
            'password',
            'role',
            'status',
            'foto',
            'last_activity',
            'remember_token',
            'created_at' // Ensure 'created_at' is included
        )->where('id', $user->id)->first();

        $years = $months = $days = null;

        // Calculate the duration from created_at to the current date if the status is active
        if ($userData->status == 'active') {
            $createdAt = Carbon::parse($userData->created_at);
            $now = Carbon::now();

            $years = $now->diffInYears($createdAt);
            $months = $now->diffInMonths($createdAt) % 12; // Get remaining months after years
            $days = $now->diffInDays($createdAt->addMonths($months)) % 30; // Get remaining days after months
        } else {
            // Optionally set a default value or handle the inactive status case
            $years = $months = $days = 'off'; // or any other default value
        }

        // Pass the data and duration to the view
        return view('admin.profil.profil', compact('userData', 'years', 'months', 'days'));
    }
    // <!--================== END ==================-->

    // <!--================== UPDATE FOTO PROFIL ==================-->
    public function updatePhoto(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        // Menghapus foto lama jika ada
        if ($user->foto && file_exists(public_path('assets/public/img/profil/' . $user->foto))) {
            unlink(public_path('assets/public/img/profil/' . $user->foto));
        }

        // Menyimpan foto baru di assets/public/img/profil
        $fileName = time() . '.' . $request->foto->extension();
        $request->foto->move(public_path('assets/public/img/profil'), $fileName);

        // Update nama file foto di database
        $user->foto = $fileName;
        $user->save();

        // Redirect dengan session success
        return redirect()->back()->with('success', 'Foto profil berhasil diperbarui.');
    }
    // <!--================== END ==================-->

    // <!--================== UPDATE DATA DIRI ==================-->
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validation for each field
        if ($request->has('email')) {
            $request->validate([
                'email' => 'required|email',
            ]);

            // Only allow administrators to update the email
            if (Auth::user()->role === 'administrator') {
                $user->email = $request->input('email');
            } else {
                return redirect()->back()->with('statusauthorized', 'You are not authorized to update the email.');
            }
        }

        // Update other fields if present
        if ($request->has('alamat')) {
            $request->validate([
                'alamat' => 'nullable|string',
            ]);
            $user->alamat = $request->input('alamat');
        }

        if ($request->has('telp')) {
            $request->validate([
                'telp' => 'nullable|string',
            ]);
            $user->telp = $request->input('telp');
        }

        $user->save();
        // Return a success message
        return redirect()->back()->with('statusdataprofil', 'Data profil berhasil diperbarui.');
    }
    // <!--================== END ==================-->

    // <!--================== VERIFIKASI EMAIL ==================-->
    public function verifyEmail(Request $request)
    {
        $user = Auth::user();

        // Check if a code was already sent within the last 2 minutes
        if ($user->code_verified_mail_sent_at && now()->diffInMinutes($user->code_verified_mail_sent_at) <= 2) {
            return response()->json(['statusterkirim' => 'success', 'message' => 'Kode Verifikasi berhasil terkirim ke email anda'], 200);
        }

        // Generate a new verification code
        $verificationCode = sprintf('%06d', random_int(0, 999999));

        \Log::info('Generating verification code: ' . $verificationCode);

        // Update the user's verification code and timestamp
        $user->code_verified_mail = $verificationCode;
        $user->code_verified_mail_sent_at = now();
        $user->save();

        // Send the verification code via email
        Mail::to($user->email)->send(new VerificationCodeMail($verificationCode));

        return response()->json(['statusterkirim' => 'success', 'message' => 'Kode Verifikasi berhasil terkirim ke email anda'], 200);
    }

    public function verify(Request $request)
    {
        $user = Auth::user();
        $verificationCode = $request->input('verification_code');

        // Check if the code is correct and was sent within the last 2 minutes
        if ($user->code_verified_mail == $verificationCode) {
            if (now()->diffInMinutes($user->code_verified_mail_sent_at) <= 2) {
                $user->email_verified_at = now();
                $user->code_verified_mail = null;
                $user->code_verified_mail_sent_at = null;
                $user->save();

                return response()->json([
                    'statusvalid' => 'success',
                    'message' => 'Email Berhasil Terverifikasi!'
                ]);
            } else {
                return response()->json([
                    'statuskadaluarsa' => 'error',
                    'message' => 'Verifikasi Kode Sudah Kadaluarsa!'
                ]);
            }
        } else {
            return response()->json([
                'statustidakvalid' => 'error',
                'message' => 'Kode Verifikasi Tidak Valid!'
            ]);
        }
    }

    // <!--================== END ==================-->

    // <!--================== RESET PASSWORD ==================-->
    public function resetPassword(Request $request)
    {
        $user = Auth::user();

        // Validasi input
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Cek apakah password lama sesuai
        if (!Hash::check($request->input('old_password'), $user->password)) {
            return response()->json([
                'statuserrorreset' => 'error',
                'message' => 'Password lama tidak sesuai, Silahkan masukan password lama yang sesuai!',
            ]);
        }

        // Update password dengan yang baru
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return response()->json([
            'statussuksesreset' => 'success',
            'message' => 'Password anda berhasil diubah!',
        ]);
    }
    // <!--================== END ==================-->
}
