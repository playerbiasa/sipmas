<?php

namespace App\Http\Controllers\LayananApi;

use App\Mail\OtpMail;
use App\Models\Prodi;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ApiController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nim' => 'required|unique:mahasiswas',
            'email' => 'required|email|unique:mahasiswas',
            'password' => 'required|min:6',
            'confirmPassword' => 'required|same:password',
            'prodi' => 'required|exists:prodis,id',
        ]);

        $otp = rand(100000, 999999); // Generate OTP
        $otpExpiredAt = Carbon::now()->addMinutes(2); // OTP berlaku 2 menit

        $mahasiswa = Mahasiswa::create([
            'nama_mahasiswa' => $request->nama,
            'nim' => $request->nim,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'prodi_id' => $request->prodi,
            'otp' => $otp,
            'otp_expired_at' => $otpExpiredAt,
        ]);

        Mail::to($mahasiswa->email)->send(new OtpMail($otp));

        return response()->json([
            'message' => 'OTP telah dikirim ke email Anda',
            'success' => true,
            'data' => $mahasiswa
        ], 201);
    }

    public function login(Request $request)
    {
        // Validasi input login
        $request->validate([
            'login' => 'required',
            'password' => 'required',
        ]);

        // Cari mahasiswa berdasarkan email atau NIM
        $mahasiswa = Mahasiswa::where('email', $request->login)
            ->orWhere('nim', $request->login)
            ->first();

        // Cek apakah mahasiswa ditemukan dan password valid
        if (!$mahasiswa || !Hash::check($request->password, $mahasiswa->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Email/NIM atau password salah'
            ], 401);
        }

        // Cek apakah akun sudah diverifikasi berdasarkan field is_verified
        if ($mahasiswa->is_verified == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Akun belum terverifikasi. Silakan masukkan OTP yang dikirim ke email.',
                'email' => $mahasiswa->email
            ], 403);
        }

        // Generate Token
        $token = $mahasiswa->createToken('authToken')->plainTextToken;

        // Return token dan data mahasiswa
        return response()->json([
            'success' => true,  // Tambahkan success: true
            'message' => 'Login berhasil',
            'token' => $token,
            'user' => $mahasiswa
        ], 200);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric',
        ]);

        $mahasiswa = Mahasiswa::where('otp', $request->otp)->first();

        if (!$mahasiswa) {
            return response()->json([
                'message' => 'OTP tidak ditemukan',
                'success' => false
            ], 404);
        }

        // Cek apakah OTP sudah kadaluarsa
        if ($mahasiswa->otp_expired_at && Carbon::now()->greaterThan($mahasiswa->otp_expired_at)) {
            return response()->json([
                'message' => 'OTP telah kedaluwarsa. Silakan minta OTP baru.',
                'success' => false
            ], 400);
        }

        // Cek apakah OTP benar
        if ($mahasiswa->otp != $request->otp) {
            return response()->json([
                'message' => 'OTP tidak valid',
                'success' => false
            ], 400);
        }

        // Verifikasi berhasil, hapus OTP agar tidak bisa digunakan kembali
        $mahasiswa->update([
            'is_verified' => true,
            'otp' => null,
            'otp_expired_at' => null,
        ]);

        return response()->json([
            'message' => 'Verifikasi berhasil',
            'success' => true
        ], 200);
    }

    public function resendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $mahasiswa = Mahasiswa::where('email', $request->email)->first();

        if (!$mahasiswa) {
            return response()->json([
                'message' => 'Mahasiswa tidak ditemukan',
                'success' => false
            ], 404);
        }

        // Generate OTP baru
        $otp = rand(100000, 999999);
        $otpExpiredAt = Carbon::now()->addMinutes(2);

        // Perbarui OTP dan waktu kedaluwarsa
        $mahasiswa->update([
            'otp' => $otp,
            'otp_expired_at' => $otpExpiredAt,
        ]);

        // Kirim ulang OTP ke email
        Mail::to($mahasiswa->email)->send(new OtpMail($otp));

        return response()->json([
            'message' => 'OTP baru telah dikirim ke email Anda',
            'success' => true,
            'data' => $mahasiswa
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json([
            'success' => true,
            'message' => 'Logout berhasil'
        ]);
    }

    public function programstudi()
    {
        $prodis = Prodi::all();
        return response()->json([
            'success' => true,
            'message' => 'Data program studi',
            'data' => $prodis
        ], 200);
    }
}
