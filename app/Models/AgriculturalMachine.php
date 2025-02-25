<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgriculturalMachine extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'license_plate', 'daily_price'];

    public function rentals()
    {
        return $this->hasMany(Rental::class, 'machine_id');
    }
}
