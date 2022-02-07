<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = ['ca mark','exam mark','student_id','course_id'];

    public function student(){
        return $this->belongsTo(Student::class);
    }

}
