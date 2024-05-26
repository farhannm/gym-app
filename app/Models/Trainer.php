<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    use HasFactory;

    protected $table = 'trainers';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'specialization',
        'join_date',
    ];

    public function classes()
    {
        return $this->hasMany(Classes::class, 'trainer_id');
    }
}
