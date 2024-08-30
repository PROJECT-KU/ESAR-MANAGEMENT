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

class DataPenggunaController extends Controller
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
        $query = User::query();

        // Search functionality
        if ($request->has('search')) {
            $search = $request->input('search');

            // Handle special cases for email_verified_at
            if (strtolower($search) === 'terverifikasi') {
                $query->whereNotNull('email_verified_at');
            } elseif (strtolower($search) === 'belum terverifikasi') {
                $query->whereNull('email_verified_at');
            } else {
                // Regular search for other fields
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('role', 'like', "%{$search}%")
                        ->orWhere('status', 'like', "%{$search}%");
                });
            }
        }

        // Sorting functionality
        if ($request->has('sort_by')) {
            $sortBy = $request->input('sort_by');
            if ($sortBy == 'latest') {
                $query->orderBy('created_at', 'desc');
            } elseif ($sortBy == 'oldest') {
                $query->orderBy('created_at', 'asc');
            }
        } else {
            // Default sorting (e.g., latest by default)
            $query->orderBy('created_at', 'desc');
        }

        // Fetch paginated data
        $users = $query->paginate(10); // Adjust the number per page as needed

        return view('admin.pengguna.index', ['users' => $users]);
    }
    // <!--================== END ==================-->

    // <!--================== MENAMPILKAN DATA PER PENGGUNA ==================-->
    public function edit(Request $request, $id)
    {
        $userData = User::findOrFail($id);

        $years = $months = $days = null;

        // Calculate the duration from created_at to the current date if the status is active
        if ($userData->status == 'active') {
            $createdAt = Carbon::parse($userData->created_at);
            $now = Carbon::now();

            $years = $now->diffInYears($createdAt);
            $months = $now->diffInMonths($createdAt) % 12; // Get remaining months after years
            $days = $now->diffInDays($createdAt->addMonths($months)) % 30; // Get remaining days after months
        } else {
            $years = $months = $days = 'off'; // or any other default value
        }

        // Pass the data and duration to the view
        return view('admin.pengguna.edit', compact('userData', 'years', 'months', 'days'));
    }
    // <!--================== END ==================-->

    // <!--================== UPDATE DATA DIRI ==================-->
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Check if the 'Verifikasi' button was clicked
        if ($request->has('code_verified_mail') && is_null($user->email_verified_at)) {
            // Update the email_verified_at field with the current timestamp
            $user->email_verified_at = now();
        }

        // Update other fields if present
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

        if ($request->has('role')) {
            $request->validate([
                'role' => 'nullable|string',
            ]);
            $user->role = $request->input('role');
        }

        if ($request->has('status')) {
            $request->validate([
                'status' => 'nullable|string',
            ]);
            $user->status = $request->input('status');
        }

        $user->save();

        // Return a success message
        return redirect()->back()->with('statusdataprofil', 'Data profil berhasil diperbarui.');
    }
    // <!--================== END ==================-->

    // <!--================== UPDATE FOTO PROFIL ==================-->
    public function updatePhoto(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Remove old photo if it exists
        if ($user->foto && file_exists(public_path('assets/public/img/profil/' . $user->foto))) {
            unlink(public_path('assets/public/img/profil/' . $user->foto));
        }

        // Save the new photo
        $fileName = time() . '.' . $request->foto->extension();
        $request->foto->move(public_path('assets/public/img/profil'), $fileName);

        // Update the photo filename in the database
        $user->foto = $fileName;
        $user->save();

        // Redirect with success message
        return redirect()->back()->with('success', 'Foto profil berhasil diperbarui.');
    }
    // <!--================== END ==================-->

    // <!--================== RESET PASSWORD ==================-->
    public function resetPassword(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validate input
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Update password with the new one
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return response()->json([
            'statussuksesreset' => 'success',
            'message' => 'Password anda berhasil diubah!',
        ]);
    }
    // <!--================== END ==================-->

    // <!--================== DELETE DATA ==================-->
    public function destroy(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Delete the associated photo if it exists
        if ($user->foto && file_exists(public_path('assets/public/img/profil/' . $user->foto))) {
            unlink(public_path('assets/public/img/profil/' . $user->foto));
        }

        // Delete the user record
        $user->delete();

        return redirect()->route('auth.view.pengguna')->with('statusdatadeleted', 'Data pengguna berhasil dihapus.');
    }
    // <!--================== END ==================-->
}
