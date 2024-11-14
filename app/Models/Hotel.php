<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Hotel extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $primaryKey  = 'hotelid';
    public $table = "TPHotel";
	protected $fillable = ['things_to_know']; // Specify which fields are fillable
}
