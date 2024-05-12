<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    protected $fillable = [
        'className',
        'grade',
        'majorID',
        'curriculumID',
        'totalStudent'
    ];
    public function student()
    {
        return $this->hasMany(Student::class, 'classID');
    }

    public function major()
    {
        return $this->belongsTo(Major::class, 'majorID');
    }

    public function curriculum()
    {
        return $this->belongsTo(curriculums::class, 'curriculumID');
    }
}
