<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Payment;
use App\Models\Reservations;
use App\Models\Trainer;
use App\Models\User;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
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
        $trainers = Trainer::all();
        //return $users;
        return view('admin.coach', compact('trainers'));
    }

    public function viewClasses()
    {
        // Mengambil semua kelas beserta informasi trainer
        $classes = Classes::with('trainer')->get();

        return view('admin.classes', compact('classes'));
    }

    public function viewPayment()
    {
         $payments = Payment::all();

        // Get all reservations made by the logged-in user, along with the associated class, trainer, and payment
        $reservations = Reservations::with(['class.trainer', 'user', 'payment'])->get();

        // Pass the reservations and payments to the view
        return view('admin.payment', [
            'reservations' => $reservations,
            'payments' => $payments
        ]);
    }

    public function createUserForm()
    {
        return view('admin.create_user');
    }

    public function updateUser($id)
    {
        $user = User::findOrFail($id);

        return view('admin.update_user', compact('user'));
    }

    public function createCoachForm()
    {
        return view('admin.create_coach');
    }

    public function updateCoach($id)
    {
        $trainer = Trainer::findOrFail($id);

        return view('admin.update_coach', compact('trainer'));
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

    public function storeCoach(Request $request)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:trainers,email'],
            'phone' => ['required', 'string', 'max:20'],
            'specialization' => ['required', 'string', 'max:255'],
        ]);

        try {
            // Membuat trainer baru
            $trainer = Trainer::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'],
                'specialization' => $validatedData['specialization'],
                'join_date' => DB::raw('NOW()'),
            ]);

            event(new Registered($trainer));

            // Mengembalikan respons sukses
            return redirect()->route('admin.coach')->with('success', 'Coach created successfully.');
        } catch (\Exception $e) {
            // Log the error message
            Log::error('Failed to create Coach: ' . $e->getMessage());
            // Mengembalikan respons gagal
            return redirect()->route('admin.coach')->with('error', 'Failed to create Coach: ' . $e->getMessage());
        }
    }


    public function updateDataCoach(Request $request, $id)
    {
        try {
            // Ambil data trainer berdasarkan trainer_id
            $trainer = Trainer::findOrFail($id);

            // Validasi input
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:15',
                'specialization' => 'required|string|max:255',
            ]);

            // Update data trainer
            $trainer->update($validatedData);

            return redirect()->route('admin.coach')->with('success', 'Trainer updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.coach')->with('error', 'Failed to update trainer: ' . $e->getMessage());
        }
    }

    public function updateDataUser(Request $request, $id)
    {
        try {
            // Ambil data user berdasarkan user_id
            $user = User::findOrFail($id);

            // Validasi input
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'role' => 'nullable|string|max:255',
            ]);

            // Update data user
            $user->update($validatedData);

            return redirect()->route('admin.user')->with('success', 'User updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.user')->with('error', 'Failed to update user: ' . $e->getMessage());
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

    public function destroyCoach($id)
    {
        try {
            $trainer = Trainer::findOrFail($id);
            $trainer->delete();
    
            return redirect()->route('admin.coach')->with('success', 'Trainer deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.coach')->with('error', 'Failed to delete trainer: ' . $e->getMessage());
        }
    }



}
