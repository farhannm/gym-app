<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservations extends Model
{
    use HasFactory;

    protected $table = 'reservations';

    protected $fillable = [
        'user_id',
        'class_id',
        'reservation_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function class()
    {
        return $this->belongsTo(Classes::class, 'id');
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'id');
    }
}
