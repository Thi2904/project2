<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teachers extends Model
{
    use HasFactory;
    protected $fillable = [
        'userID',
        'teacherCode',
        'majorID'
    ];
    public function major()
    {
        return $this->belongsTo(Major::class, 'majorID');
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'userID');
    }
}
