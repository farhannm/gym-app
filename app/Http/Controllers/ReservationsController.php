<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Payment;
use App\Models\Reservations;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */

    public function createReservationForm()
    {   
        $classes = Classes::all();

        // Kirim data kelas dan reservasi ke view
        return view('create_reservation', [
            'classes' => $classes
        ]);
    }
    
    public function create(Request $request)
    {
        // Validasi input
        $request->validate([
            'class_id' => 'required',
            'reservation_date' => 'required|date'
        ]);

        // Ambil user yang sedang login
        $user = Auth::user();

        // Set payment_date to today
        $paymentDate = Carbon::today()->toDateString();

        // Create the payment with default status 'Not Paid' if not provided
        $payment = Payment::create([
            'user_id' => $user->id,
            'amount' => 20000,  // Fixed amount
            'payment_date' => $paymentDate,
            'status' => $request->input('status', 'Not Paid'),  // Default to 'Not Paid'
        ]);

        // Buat reservasi baru
        $reservation = new Reservations();
        $reservation->user_id = $user->id;
        $reservation->class_id = $request->class_id;
        $reservation->payment_id = $payment->id;  // Assign the payment ID
        $reservation->reservation_date = $request->reservation_date;
        $reservation->save();

        // Redirect dengan pesan sukses
        return redirect()->route('schedule_class')->with('success', 'Reservation created successfully!');
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
    public function show(Reservations $reservations)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservations $reservations)
    {
        //
    }

    public function update($id)
    {
        // Find the payment by ID
        $payment = Payment::findOrFail($id);

        // Update the payment status to 'Already Paid'
        $payment->update(['status' => 'Already Paid']);

        // Return a view with a success message
        return redirect()->route('schedule_class')->with('message', 'Payment status updated successfully');
    }

    public function updatePaymentAdmin($id)
    {
        // Find the payment by ID
        $payment = Payment::findOrFail($id);

        $payment->update(['status' => 'Verified']);

        // Return a view with a success message
        return redirect()->route('admin.payment')->with('message', 'Payment status updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Hapus reservasi
            $reservations = Reservations::findOrFail($id);
            $reservations->delete();

            // Hapus pembayaran yang terkait jika ada
            if ($reservations->payment) {
                $reservations->payment->delete();
            }

            // Redirect dengan pesan sukses
            return redirect()->route('admin.payment')->with('success', 'Reservation deleted successfully!');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan

            // Redirect dengan pesan error
            return redirect()->route('admin.payment')->with('error', 'Failed to delete reservation. Please try again.');
        }
    }
}
