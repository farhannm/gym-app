<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Equipment;
use App\Models\Payment;
use App\Models\Reservations;
use App\Models\Trainer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard');
    }

    public function viewReservation()
    {
        // Get the currently logged-in user
        $user = Auth::user();

         // Get all payments made by the logged-in user
         $payments = Payment::where('user_id', $user->id)->get();

        // Get all reservations made by the logged-in user, along with the associated class, trainer, and payment
        $reservations = Reservations::where('user_id', $user->id)->with(['class.trainer', 'payment'])->get();

        // Pass the reservations and payments to the view
        return view('reservation', [
            'reservations' => $reservations,
            'payments' => $payments
        ]);
    }

    public function viewCoach()
    {
        $trainers = Trainer::all();
        
        return view('coach', compact('trainers'));
    }

    public function viewEquipments()
    {
        $equipments = Equipment::all();

        return view('equipment', compact('equipments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(User $users)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $users)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $users)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $users)
    {
        //
    }
}
