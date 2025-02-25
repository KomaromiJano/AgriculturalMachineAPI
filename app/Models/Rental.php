<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = ['rental_start', 'rental_end', 'machine_id'];

    public function machine()
    {
        return $this->belongsTo(AgriculturalMachine::class, 'machine_id');
    }
}
