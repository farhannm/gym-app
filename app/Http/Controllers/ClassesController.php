<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Reservations;
use App\Models\Trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function createClassForm()
    {
        return view('admin.create_class');
    }

    public function viewTrainer()
    {
        // Mengambil semua kelas beserta informasi trainer
        $trainers = Trainer::all();

        return view('admin.create_class', compact('trainers'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'trainer_id' => 'required|exists:trainers,id',
        ]);

        // Buat kelas baru
        $class = Classes::create($validatedData);

        // Redirect ke halaman yang sesuai atau tampilkan pesan sukses
        return redirect()->route('admin.classes')->with('success', 'Class created successfully');
    }

    public function updateClass($id)
    {
        $classes = Classes::findOrFail($id);
        $trainers = Trainer::all();

        return view('admin.update_class', compact('classes'), compact('trainers'));
    }

    public function updateDataClass(Request $request, $id)
    {
        try {
            // Ambil data kelas berdasarkan ID
            $class = Classes::findOrFail($id);

            // Validasi input
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'start_time' => 'required',
                'end_time' => 'required',
                'trainer_id' => 'required',
            ]);

            // Update data kelas
            $class->update($validatedData);

            return redirect()->route('admin.classes')->with('success', 'Class updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.classes')->with('error', 'Failed to update class: ' . $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Classes $classes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classes $classes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classes $classes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyClass($id)
    {
        try {
            $trainer = Classes::findOrFail($id);
            $trainer->delete();
    
            return redirect()->route('admin.classes')->with('success', 'Classes deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.classes')->with('error', 'Failed to delete Class: ' . $e->getMessage());
        }
    }

    public function search(Request $request)
    {
        // Ambil user yang sedang login
        $user = Auth::user();

        $reservations = Reservations::with(['user', 'class'])->where('user_id', $user->id)->get();

        $query = Classes::query();

        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        $classes = $query->with('trainer')->get();

        // Kirim data kelas dan reservasi ke view
        return view('reservation', [
            'classes' => $classes,
            'reservations' => $reservations
        ]);
    }
}
