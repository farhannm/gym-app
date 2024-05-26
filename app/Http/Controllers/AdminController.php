<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function viewUser()
    {
        $users = User::all();
        //return $users;
        return view('admin.user', compact('users'));
    }

    public function viewCoach()
    {
        return view('admin.coach');
    }

    public function viewClasses()
    {
        return view('admin.classes');
    }

    public function createUserForm()
    {
        return view('admin.create_user');
    }

    public function store(Request $request)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        try {
            // Membuat user baru
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
            ]);

            // Memicu event bahwa user baru telah terdaftar
            event(new Registered($user));

            // Mengembalikan respons sukses
            return redirect()->route('admin.user')->with('success', 'User created successfully.');
        } catch (\Exception $e) {
            // Mengembalikan respons gagal
            return redirect()->route('admin.user')->with('error', 'Failed to create user: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return redirect()->route('admin.user')->with('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.user')->with('error', 'Failed to delete user: ' . $e->getMessage());
        }
    }
}
