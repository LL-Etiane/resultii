<?php

namespace App\Models;

use App\Models\ConcourImage;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concour extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function concourImage(){
        return $this->hasMany(ConcourImage::class);
    }
}
