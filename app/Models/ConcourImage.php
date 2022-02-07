<?php

namespace App\Models;

use App\Models\Concour;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConcourImage extends Model
{
    use HasFactory;

    protected $fillable = ['image'];

    public function concour(){
        return $this->belongsTo(Concour::class);
    }
}
