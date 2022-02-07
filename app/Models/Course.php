<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['course code', 'course title', 'course value'];

    public function departments(){
        return $this->belongsToMany(Department::class);
    }
    
}
