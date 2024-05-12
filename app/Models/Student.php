<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'studentName',
        'phoneNumber',
        'email',
        'classID',
        'gender'
    ];
    public function class()
    {
        return $this->belongsTo(Classes::class, 'classID');
    }
}
