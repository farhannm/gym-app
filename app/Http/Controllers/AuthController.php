<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        // Coba login
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Jika login berhasil
            return response()->json(['success' => true]);
        } else {
            // Jika login gagal
            return response()->json(['errors' => ['email' => ['Invalid credentials.']]], 422);
        }
    }
}
